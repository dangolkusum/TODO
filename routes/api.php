<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks/all',[TaskController::class,'gettasks']);
Route::post('/tasks/create',[TaskController::class,'create']);
Route::get('/task/{id}/show',[TaskController::class,'task']);
Route::put('/tasks/{id}/update',[TaskController::class,'update']);
Route::patch('/task/{id}/toggle',[TaskController::class,'toggleComplete']);
Route::get('/task/{id}/delete',[TaskController::class,'delete']);