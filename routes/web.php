<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth','admin'])->group(function(){
    Route::get('/admin', [GuestController::class,'index']);
});

Route::middleware(['auth','MailVerif'])->group(function(){
    Route::get('/isverif', [UserController::class,'index']);
});
