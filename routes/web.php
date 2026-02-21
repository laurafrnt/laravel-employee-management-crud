<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// Route de vue et de modification de profile
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('user.profile');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('user.profile.store');

// Route suppression de compte utilisateur depuis le profile
Route::delete('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('user.profile.destroy');

// Routes protégées par le middleware 'can:Dashboard admin'
Route::prefix('dashboard')->group(function () {
    Route::group(['middleware' => ['can:edit.user']], function () {
        // Permet d'avoir accès au CRUD sur User
        Route::resource('/users', UserController::class);
    });
});

