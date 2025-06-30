<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubTashController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])
        ->middleware('throttle:100,1')
        ->name('authenticate');

    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('tasks')->name('task.')->middleware(['auth', 'throttle:60,1'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/store', [TaskController::class, 'store'])->name('store');
    Route::get('/{task}', [TaskController::class, 'show'])->name('show');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');

    Route::prefix('{task}/sub')->name('sub.')->group(function () {
        Route::get('/create', [SubTashController::class, 'create'])->name('create');
        Route::post('/store', [SubTashController::class, 'store'])->name('store');
        Route::get('/{sub}', [SubTashController::class, 'show'])->name('show');
        Route::get('/{sub}/edit', [SubTashController::class, 'edit'])->name('edit');
        Route::put('/{sub}', [SubTashController::class, 'update'])->name('update');
        Route::delete('/{sub}', [SubTashController::class, 'destroy'])->name('destroy');

    });
});


