<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[TaskController::class, 'index']);
Route::post('/tasks',[TaskController::class, 'store']);
Route::put('/tasks/{task}',[TaskController::class, 'update']);
Route::get('/tasks/{task}',[TaskController::class, 'destroy']);