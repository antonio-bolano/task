<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Tasks\CreateTaskController;
use App\Http\Controllers\Tasks\DeleteTaskController;
use App\Http\Controllers\Tasks\GetAllTasksController;
use App\Http\Controllers\Tasks\GetTaskController;
use App\Http\Controllers\Tasks\UpdateTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', LogoutController::class);

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('tasks')->group(function () {
        Route::get('/', GetAllTasksController::class);
        Route::post('/', CreateTaskController::class);
        Route::put('/', UpdateTaskController::class);
        Route::delete('/', DeleteTaskController::class);
        Route::get('/{task}', GetTaskController::class);
    });

});
