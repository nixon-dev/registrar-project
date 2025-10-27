<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'role:Administrator'])->prefix('dioikitis')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');


    Route::get('/document-tracking/{id}', [AdminController::class, 'view_document'])->name('admin.document-view');

    Route::get('/document-tracking', [AdminController::class, 'document_tracking'])->name('admin.document');

    Route::post('/document-tracking/add', [AdminController::class, 'document_request_add'])->name('admin.document-add-request');

    Route::post('/document-tracking/update', [AdminController::class, 'document_request_update'])->name('admin.document-update-request');



    Route::get('/user-settings', [AdminController::class, 'user_settings'])->name('admin.user-settings');

    Route::get('/users', [AdminController::class, 'users_list'])->name('admin.users-list');

    Route::get('/users-pending', [AdminController::class, 'pending_users_list'])->name('admin.users-list-pending');

    Route::get('/users/{id}', [AdminController::class, 'view_users'])->name('admin.users-view');

    Route::post('/users/update', [AdminController::class, 'users_update'])->name('admin.users-update');

    Route::post('/user/update', [AdminController::class, 'user_update'])->name('admin.user-update');

    Route::get('/users/delete/{id}', [AdminController::class, 'users_delete'])->name('admin.users-delete');

    Route::post('/user/update-password', [ChangePasswordController::class, 'user_update_password'])->name('admin.user-update-password');

    Route::get('/history', [AdminController::class, 'history'])->name('admin.history');

    Route::get('/active-users', [AdminController::class, 'active_users'])->name('admin.active-users');

    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    Route::get('/account-settings', [AdminController::class, 'account_settings'])->name('admin.new-settings');


});