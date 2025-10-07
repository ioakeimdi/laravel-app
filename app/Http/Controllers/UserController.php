<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;

class UserController extends Controller
{
	/**
	 * Check user access
	 */
    private function checkAccess()
	{
		$user = auth()->user();

		if (! $user || ! $user->roles->contains('name', 'Technical Manager')) {
			redirect()->route('dashboard')->with('error', 'Access denied.')->send();
		}
	}
	
	/**
	 * Get all users
	 */
	public function index()
    {
		$this->checkAccess();

		$users = User::with('roles')->get();
		
    	return view('pages.users', compact('users'));
    }

	/**
	 * Fill form data
	 */
	public function form($id = null)
	{
		$this->checkAccess();

		if ($id) {
			try {
				$user = User::with('roles')->findOrFail($id);
			} catch (ModelNotFoundException $e) {
				$user = null;
			}
		} else {
			$user = null;
		}

		$roles = UserRole::where('is_active', 1)->get();

		return view('pages.register', compact('user', 'roles'));
	}

	/**
	 * Update user
	 */
	public function update(Request $request, $id)
	{
		$request->validate([
			'name'     => 'required|string|max:255',
			'username' => 'required|string|max:255|unique:dv_users,username,' . $id,
			'email'    => 'required|email|unique:dv_users,email,' . $id,
			'password' => 'nullable|string|min:6|confirmed',
			'roles'    => 'required|array',
        	'roles.*'  => 'exists:dv_users_roles,id',
		]);

		try {
			$user = User::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			return response()->json([
				'success' => false,
				'message' => 'User not found.',
			], 404);
		}

		$user->update([
			'name'      => $request->name,
			'username'  => $request->username,
			'email'     => $request->email,
			'is_active' => $request->has('is_active') ? 1 : 0,
			'password'  => $request->password ? Hash::make($request->password) : $user->password,
		]);

		$user->roles()->sync($request->roles);

		return response()->json([
			'success'  => true,
			'message'  => 'User updated successfully.',
			'redirect' => route('dashboard.users'),
		]);
	}

    /**
	 * Register user form submission
	 */
	public function register(Request $request)
    {
        $request->validate([
			'name'     => 'required|string|max:255',
			'username' => 'required|string|max:255|unique:dv_users,username',
			'email'    => 'required|email|unique:dv_users,email',
			'password' => 'required|string|min:6|confirmed',
			'roles'    => 'array',
        	'roles.*'  => 'exists:dv_users_roles,id',
		]);

		$isActive = $request->has('is_active') ? 1 : 0;

        $user = User::create([
			'name'      => $request->name,
			'username'  => $request->username,
			'email'     => $request->email,
			'password'  => Hash::make($request->password),
			'is_active' => $isActive,
		]);

		$user->roles()->sync($request->roles);

		return response()->json([
			'success'  => true,
			'message'  => 'Registration successful.',
			'redirect' => route('dashboard.users'),
		]);
    }
}
