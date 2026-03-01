<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\PersonalTaskController;
use App\Http\Controllers\partnershipController;
use App\Http\Controllers\jointWorkerController;
use App\Http\Controllers\checkPointController;

require __DIR__.'/admin.php';
require __DIR__.'/worker.php';
require __DIR__.'/PM.php';
require __DIR__.'/executive.php';

Route::get('/', function () {
    return view('landingPage');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::get('/register', [UserController::class, 'showRegistForm'])->name('register');
Route::post('/login-confirmation', [UserController::class, 'login'])->name('login-confirmation');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/users/add', [UserController::class, 'store'])->name('users.store');

Route::middleware('auth')->group(function () {
//personal task route
Route::get('/personal-tasks', [PersonalTaskController::class, 'index'])->name('tasks.index');
Route::get('/personal-tasks/list', [PersonalTaskController::class, 'list'])->name('tasks.list');
Route::post('/personal-tasks/store', [PersonalTaskController::class, 'store'])->name('tasks.store');
Route::patch('/personal-tasks/{id}/status', [PersonalTaskController::class, 'updateStatus'])->name('tasks.updateStatus');

});
