<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/',function(){

    return response()->json([
        'message'=> "Welcome to Hash360 API",
        'Laravel Version'=>app()->version()
    ]);
});

Route::resource('products', ProductController::class);
// Route::resource('users',UserController::class);

Route::group(['namespace' => 'API'], function() {
    // User Create Route
    Route::post('register',[AuthController::class,'create_user']);
    Route::post('login',[AuthController::class,'login']);

    // Password Reset Routes
    Route::post('reset-password',[PasswordResetController::class,'send_reset_token']);
    Route::get('confirm-reset-token/{token}',[PasswordResetController::class,'confirm_reset_token']);
    Route::post('update-password',[PasswordResetController::class,'update_password']);
    // check user loggin status
    Route::get('check',[UserController::class,'check']);

});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('test',function(){

        return response()->json([
            'message'=> "Welcome Hash360 API",
            'Laravel Version'=>app()->version()
        ]);
    });

    Route::group(['namespace' => 'API'], function() {
        Route::get('user',[UserController::class,'index']);
        Route::get('user/{id}',[UserController::class,'user']);
        Route::get('users',[UserController::class,'users']);
        Route::post('user/update/{id}',[UserController::class,'update_user']);
        Route::post('user/update',[UserController::class,'update']);
        Route::post('user/upload_img',[UserController::class,'upload_img']);
 
    });

    Route::get('logout',[AuthController::class,'logout']);
    
    });