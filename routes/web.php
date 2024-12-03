<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

// Redirect default path
Route::get('/', function () {
    return redirect()->route('todo.index');
});

// Page awal
Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');

// Create data baru
Route::post('/todo', [TodoController::class, 'store'])->name('todo.post');

// Update data
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.put');

// Delete data
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');