<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveRequestController;

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect(route('dashboard'));
    });

    Route::get('/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('user.approval');
    Route::resource('users', UserController::class)->only('index');

    Route::resource('leave_requests', LeaveRequestController::class)->except(['edit', 'destroy']);
});

require __DIR__ . '/auth.php';
