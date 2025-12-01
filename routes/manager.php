<?php

use App\Http\Controllers\Manager\ProfileController;

Route::middleware('auth')->group(function () {
    Route::prefix('manager')->middleware('manager')->name('manager.')->group(callback: function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    });
});
