<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [TodoController::class, 'index'])->middleware(['middleware' => 'auth'])->name('todo.index');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todo.create');
Route::post('/todos/store', [TodoController::class, 'store'])->name('todo.store');

Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');
Route::patch('/todos/{todo}', [TodoController::class, 'update'])->name('todo.update');

Route::get('/todos/{todo}/complete', [TodoController::class, 'complete'])->name('todo.complete');
Route::get('/todos/{todo}/uncomplete', [TodoController::class, 'uncomplete'])->name('todo.uncomplete');

Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todo.delete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
