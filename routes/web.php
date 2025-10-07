<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// Home
Route::get('/', function () {
    return view('pages.home');
})->name('home');


// Login
Route::get('/login', function () {
    return view('pages.login');
})->name('login');

// Login action
Route::post('/login', [AuthController::class, 'login'])->name('login.ajax');


// After login
Route::middleware('auth')->group(function () {
	// Dashboard
	Route::get('/dashboard', function () {
		return view('layouts.dashboard');
	})->name('dashboard');

	// Profile
	Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');

	// All Users
	Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users');

	// Register user
	Route::get('/dashboard/register', [UserController::class, 'form'])->name('dashboard.register');
	Route::post('/dashboard/register', [UserController::class, 'register'])->name('dashboard.register.post');

    // Edit user
    Route::get('/dashboard/users/{id}/edit', [UserController::class, 'form'])->name('dashboard.users.edit');
    Route::post('/dashboard/users/{id}/edit', [UserController::class, 'update'])->name('dashboard.user.update');
});

// Logout action
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');