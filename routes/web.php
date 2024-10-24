<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [TodoController::class, 'index'])->middleware(['middleware' => 'auth'])->name('todo.index')->middleware('verified');
Route::get ('/todos/create', [TodoController::class, 'create'])->middleware(['middleware' => 'auth'])->name('todo.create')->middleware('verified');
Route::post('/todos/store', [TodoController::class, 'store'])->middleware(['middleware' => 'auth'])->name('todo.store')->middleware('verified');

Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->middleware(['middleware' => 'auth'])->name('todo.edit')->middleware('verified');
Route::get('/todos/{todo}/view', [TodoController::class, 'view'])->middleware(['middleware' => 'auth'])->name('todo.view')->middleware('verified');
Route::patch('/todos/{todo}', [TodoController::class, 'update'])->middleware(['middleware' => 'auth'])->name('todo.update')->middleware('verified');

Route::get('/todos/{todo}/complete', [TodoController::class, 'complete'])->middleware(['middleware' => 'auth'])->name('todo.complete')->middleware('verified');
Route::get('/todos/{todo}/uncomplete', [TodoController::class, 'uncomplete'])->middleware(['middleware' => 'auth'])->name('todo.uncomplete')->middleware('verified');



Route::get('/user/{user}/panel', [UserController::class, 'panel'])->middleware(['middleware' => 'auth'])->name('todo.panel')->middleware('verified');


Route::get('/user/{user}/personal', [UserController::class, 'personal'])->middleware(['middleware' => 'auth'])->name('todo.personal')->middleware('verified');
Route::patch('/user/{user}/p_update', [UserController::class, 'p_update'])->middleware(['middleware' => 'auth'])->name('todo.p_update')->middleware('verified');

Route::get('/user/{user}/security', [UserController::class, 'security'])->middleware(['middleware' => 'auth'])->name('todo.security')->middleware('verified');
Route::patch('/user/{user}/s_update', [UserController::class, 's_update'])->middleware(['middleware' => 'auth'])->name('todo.s_update')->middleware('verified');

Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->middleware(['middleware' => 'auth'])->name('todo.delete')->middleware('verified');



Auth::routes([
    'verify' => true,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
