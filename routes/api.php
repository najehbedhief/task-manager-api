<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* Route::post('tasks', [TaskController::class, 'store']);
Route::get('tasks', [TaskController::class, 'index']);
Route::put('task/{id}', [TaskController::class, 'update']);
Route::get('task/{id}', [TaskController::class, 'show']);
Route::delete('task/{id}', [TaskController::class, 'destroy']); */

Route::apiResource('tasks', TaskController::class);
