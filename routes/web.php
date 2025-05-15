<?php

use App\Models\Task;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->middleware('auth')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [TaskController::class, 'index'])->middleware('auth')->name('home');
    Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->middleware('auth');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->middleware('auth');

    Route::put('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    
    Route::get('/completed', [TaskController::class, 'completed'])->middleware('auth');
    Route::get('/pending', [TaskController::class, 'pending'])->middleware('auth');
});

require __DIR__.'/auth.php';