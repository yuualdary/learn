<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OtpVerification;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


    Route::post('login',LoginController::class);
    // Route::post('register',RegisterController::class);


    Route::middleware(['auth','MailVerif'])->group(function(){
        Route::get('/isverif', [UserController::class,'index']);
    });
    
    Route::middleware(['auth','admin'])->group(function(){
        Route::get('/admin', [GuestController::class,'index']);
    });
    Route::post('register',[RegisterController::class,'store']);

    
    Route::middleware(['auth'])->group(function(){
        
        Route::post('validatemail',[OtpVerification::class,'MailVerification']);
        Route::post('resendotp',[OtpVerification::class,'ResendOtp']);

    });