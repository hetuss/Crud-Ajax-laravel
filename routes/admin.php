<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;



Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

//USER
Route::resource('user', UserController::class);
Route::post('/admin/user/merge', [UserController::class, 'merge'])->name('user.merge');
