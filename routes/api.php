<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('task/all', [TaskController::class, 'getAllTasks'])->middleware('CheckUser');
    Route::get('task/ordered', [TaskController::class, 'getTasksByPriority']);
    Route::post('task/{id}/favorite', [TaskController::class, 'addToFavorites']);
    Route::delete('task/{id}/favorite', [TaskController::class, 'removeFromFavorites']);
    Route::get('task/favorites', [TaskController::class, 'getFavoriteTasks']);

    Route::prefix('profile')->group(function () {
        Route::post('', [ProfileController::class, 'store']);
        Route::get('/{id}', [ProfileController::class, 'show']);
        Route::put('/{id}', [ProfileController::class, 'update']);
    });

    Route::get('user', [UserController::class, 'GetUser']);
    Route::get('users', [UserController::class, 'GetAllUsersProfile']);

    Route::get('task/{id}/user', [TaskController::class, 'getTaskUser']);
    Route::post('tasks/{taskId}/categories', [TaskController::class, 'addCategoriesToTask']);
    Route::get('tasks/{taskId}/categories', [TaskController::class, 'getTaskCategories']);
    Route::get('categories/{categoryId}/tasks', [TaskController::class, 'getCategorieTasks']);

});
