<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);         // list all tasks
    Route::post('/tasks', [TaskController::class, 'store']);        // create task
    Route::get('/tasks/{id}', [TaskController::class, 'show']);    // view single task
    Route::put('/tasks/{id}', [TaskController::class, 'update']);  // update task
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // delete task
});