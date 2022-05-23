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
Route::post("token", [UserController::class, "getToken"]);
Route::post("registration", [UserController::class, "registrateUser"]);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/user', [UserController::class, 'getUser'])->middleware('auth:sanctum');
Route::post('/add-services', [TaskController::class, 'addService'])->middleware('auth:sanctum');
Route::post('/services-by-id', [TaskController::class, 'getUserServices'])->middleware('auth:sanctum');