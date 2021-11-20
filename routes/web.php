<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/nearest-friends',[App\Http\Controllers\HomeController::class, 'nearestFriends'])->name('nearestFriends');
Route::get('/submit-interest/{id}/{value}',[\App\Http\Controllers\HomeController::class,'submitInterest'])->name('submitInterest');
Route::get('/map/{user}',[\App\Http\Controllers\HomeController::class,'map'])->name('map');
Route::get('/chat/{user}',[\App\Http\Controllers\HomeController::class,'chat'])->name('chat');

ROute::prefix('/verify')->name('verify.')->group(function(){
    Route::get('/', [App\Http\Controllers\Auth\TwoFactorController::class,'index'])->name('index');
    Route::post('/', [App\Http\Controllers\Auth\TwoFactorController::class,'store'])->name('store');
    Route::get('/resend', [App\Http\Controllers\Auth\TwoFactorController::class,'resend'])->name('resend');
    Route::get('/resend', [App\Http\Controllers\Auth\TwoFactorController::class,'resend'])->name('resend');
});


Auth::routes();