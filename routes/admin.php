<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\PersonalTaskController;
use App\Http\Controllers\partnershipController;
use App\Http\Controllers\jointWorkerController;
use App\Http\Controllers\checkPointController;

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin-home', [UserController::class, 'showAdminHome'])->name('admin.home');
        Route::get('/admin-pTask', [UserController::class, 'showAdminpTask'])->name('admin.pTask');
        //user Route
        Route::get('/users/list', [UserController::class, 'listUsers'])->name('users.index');
        Route::get('/users/create',[UserController::class, 'create'])->name('users.create');
        // Route::post('/users/add', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    });    
});