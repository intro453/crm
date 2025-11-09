<?php

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
    Route::view('/admin/profile', 'admin.profile')->middleware('admin')->name('admin.profile');
    Route::view('/manager/profile', 'manager.profile')->middleware('manager')->name('manager.profile');
    Route::view('/lawyer/profile', 'lawyer.profile')->middleware('lawyer')->name('lawyer.profile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
