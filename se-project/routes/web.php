<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProjectMemberController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Our resource routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('detail',DetailController::class);

    Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

    Route::post('/detail', [DetailController::class, 'index'])->name('detail.index');
    Route::post('/update/{id}', [DetailController::class, 'update'])->name('update');
    Route::post('/update2/{id}', [DetailController::class, 'update2'])->name('update2');
    Route::post('/createCheckpoint/{id}',[DetailController::class, 'createCheckpoint'])->name('createCheckpoint');

    Route::post('manage',[ProjectMemberController::class,'index'])->name('manage');
    Route::post('/process',[ProjectMemberController::class,'handleFormSubmission'])->name('process');
});

require __DIR__.'/auth.php';
