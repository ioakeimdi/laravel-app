<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
	 * Current logged in user info
	 */
	public function index()
    {
		$user = Auth::user();
        return view('pages.profile', compact('user'));
    }

}
