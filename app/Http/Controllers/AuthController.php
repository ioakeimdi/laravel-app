<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	/**
	 * Login form submission
	 */
    public function login(Request $request)
    {
        $request->validate([
            'user_login' => 'required|string',
            'password'   => 'required|string|min:6',
        ]);

        $login = $request->input('user_login');
    	$password = $request->input('password');
		$field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		try {
			if (Auth::attempt([$field => $login, 'password' => $password])) {
				$request->session()->regenerate();

				return response()->json([
					'success'  => true,
					'message'  => 'Login successful',
					'redirect' => route('dashboard'),
				]);
			}
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'message' => 'User does not exist.',
			], 404);
		}

        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password',
        ], 401);
    }

	/**
	 * Logout
	 */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
