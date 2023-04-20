<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\User_TaskController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\StatusController;

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

Route::group(['prefix' => 'v1'], function() {

    Route::post('register', [Authcontroller::class, 'register']);
    Route::post('login', [Authcontroller::class, 'login']);
    Route::get('details/{id}', [Authcontroller::class, 'user_details']);


    Route::middleware('auth:sanctum')->group(function () {

        Route::post('logout', [Authcontroller::class, 'logout']);

        Route::apiResource('status', StatusController::class);
        Route::apiResource('tasks', TaskController::class);
        Route::apiResource('user_tasks',User_TaskController::class);

             });
});













