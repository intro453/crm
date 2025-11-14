<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CourtController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RequestTopicController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('main');

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
    Route::view('/manager/profile', 'manager.profile')->middleware('manager')->name('manager.profile');
    Route::view('/lawyer/profile', 'lawyer.profile')->middleware('lawyer')->name('lawyer.profile');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
