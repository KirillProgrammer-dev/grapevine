<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(UserController::class)->group(function () {
    Route::post("token", "getToken");
    Route::post("registration", "registrateUser");
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
    Route::post('/user', 'getUser')->middleware('auth:sanctum');
    Route::post('/edit', 'editProfile')->middleware('auth:sanctum');
});
Route::controller(TaskController::class)->group(function () {
    Route::post('/add-services', 'addService')->middleware('auth:sanctum');
    Route::post('/services-by-id', 'getUserServices')->middleware('auth:sanctum');
    Route::post("all-services", "allServices");
    Route::post("/set-executor-for-task", "setExecutorForTask")->middleware('auth:sanctum');
});