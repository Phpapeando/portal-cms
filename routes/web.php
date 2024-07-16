<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteContentController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteFieldController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckProfile;
use Illuminate\Support\Facades\Route;

Route::get('/login', [UserController::class, 'loginIndex'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/sites/create', [SiteController::class, 'create'])->name('sites.create')->middleware('check-profile');
    Route::get('sites/{id}', [SiteController::class, 'show'])->name('sites.show');
    
    Route::get('sites/{site}/fields/create', [SiteContentController::class, 'createFields'])->name('site_fields.create');
    Route::post('sites/{site}/fields', [SiteContentController::class, 'storeFields'])->name('site_fields.store');
    Route::get('sites/{site}/contents/create', [SiteContentController::class, 'createContents'])->name('site_contents.create');
    Route::post('sites/{site}/contents', [SiteContentController::class, 'storeContents'])->name('site_contents.store');
    Route::get('/sites/{site}/contents/edit', [SiteContentController::class, 'editAllContents'])->name('site_contents.edit_all');
    Route::put('/sites/{site}/contents', [SiteContentController::class, 'updateAllContents'])->name('site_contents.update_all');
    Route::put('sites/{site}/contents/{content}', [SiteContentController::class, 'updateContents'])->name('site_contents.update');
    Route::delete('sites/{site}/contents/{content}', [SiteContentController::class, 'destroyContents'])->name('site_contents.destroy');
    
    Route::get('sites/{site}/fields/manage', [SiteFieldController::class, 'manageFields'])->name('site_fields.manage');
    //Route::get('sites/{site}/fields/create', [SiteFieldController::class, 'create'])->name('site_fields.create');
    //Route::post('sites/{site}/fields', [SiteFieldController::class, 'store'])->name('site_fields.store');
    Route::get('sites/{site}/fields/{field}/edit', [SiteFieldController::class, 'edit'])->name('site_fields.edit');
    Route::put('sites/{site}/fields/{field}', [SiteFieldController::class, 'update'])->name('site_fields.update');
    Route::delete('sites/{site}/fields/{field}', [SiteFieldController::class, 'destroy'])->name('site_fields.destroy');
});

Route::middleware('auth', 'check-profile')->group(function () {
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
   
    Route::get('sites/{id}/details', [SiteController::class, 'details'])->name('sites.details');
    
    Route::post('/sites', [SiteController::class, 'store'])->name('sites.store');
    Route::get('/sites/{id}/edit', [SiteController::class, 'edit'])->name('sites.edit');
    Route::put('/sites/{id}', [SiteController::class, 'update'])->name('sites.update');
    Route::delete('/sites/{id}', [SiteController::class, 'destroy'])->name('sites.destroy');
});

