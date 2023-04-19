<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\PersonController;
use Illuminate\Http\Request;
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

Route::middleware('guest')->group(function () {

    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function(){
    Route::delete('logout', [AuthController::class, 'logout']);
    Route::get('/user',function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/people',PeopleController::class);
    Route::apiResource('/person',PersonController::class);
});
