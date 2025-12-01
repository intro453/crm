<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CourtController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RequestTopicController;
use App\Http\Controllers\Admin\UserController;

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->middleware('admin')->name('admin.')->group(callback: function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        Route::resource('applications', ApplicationController::class)->except('show');
        Route::resource('clients', ClientController::class)->except('show');
        Route::resource('reports', ReportController::class)->except('show');
        Route::resource('topics', RequestTopicController::class)->except('show');
        Route::resource('courts', CourtController::class)->except('show');
        Route::resource('users', UserController::class)->except('show');
    });
});
