<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/login', [UserController::class, 'loginIndex'])->name('login');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
Route::delete('/profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
Route::get('profiles/{id}/users', [ProfileController::class, 'getUsers'])->name('profiles.users');

Route::get('/sites', [SiteController::class, 'index'])->name('sites.index');
Route::get('/sites/create', [SiteController::class, 'create'])->name('sites.create');
Route::get('sites/{id}', [SiteController::class, 'show'])->name('sites.show');
Route::post('/sites', [SiteController::class, 'store'])->name('sites.store');
Route::get('/sites/{id}/edit', [SiteController::class, 'edit'])->name('sites.edit');
Route::put('/sites/{id}', [SiteController::class, 'update'])->name('sites.update');
Route::delete('/sites/{id}', [SiteController::class, 'destroy'])->name('sites.destroy');



