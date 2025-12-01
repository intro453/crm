<?php

use App\Http\Controllers\Lawyer\ProfileController;

Route::middleware('auth')->group(function () {
    Route::prefix('lawyer')->middleware('lawyer')->name('lawyer.')->group(callback: function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    });
});
