<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [GuestController::class,'index'])->name('home');

Route::get('/check', [GuestController::class,'checker'])->middleware('throttle:100,1')->name('checker');

Route::get('/registrar-admin', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/registrar-admin', [LoginController::class, 'login']);

Route::get('/hjkmqladasgq', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/hjkmqladasgq', [RegisterController::class, 'register']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route::fallback(function () {
//     return response()->view('errors.404', [], 404);
// });


require __DIR__ . '/admin.php';