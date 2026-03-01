<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [GuestController::class,'index'])->name('home');

Route::get('/check', [GuestController::class,'checker'])->name('checker');

Route::get('/registrar-admin', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/registrar-admin', [LoginController::class, 'login']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/redis-test', function () {
    Redis::set('redis_working', 'YES IT WORKS');
    return Redis::get('redis_working');
});

require __DIR__ . '/admin.php';