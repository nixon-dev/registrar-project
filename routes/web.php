<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {

//     $user = Auth::user();

//     if ($user == null) {
//         return redirect('/login');
//     }

//     if ($user->role === 'Administrator') {
//         return redirect('/admin/dashboard');
//     } elseif ($user->role === 'Staff') {
//         return redirect('/staff/dashboard');
//     } else {
//         return redirect('/login');
//     }
// })->name('index');


Route::get('/', [GuestController::class,'index'])->name('home');

Route::post('/check', [GuestController::class,'checker'])->name('checker');

Route::get('/z3t8qPjL6sA5hWk2rY7e', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/z3t8qPjL6sA5hWk2rY7e', [LoginController::class, 'login']);

Route::get('/hjkmqladasgq', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/hjkmqladasgq', [RegisterController::class, 'register']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return response()->view('404', [], 404);
});

require __DIR__ . '/admin.php';