<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class)
        ->except(['show'])
        ->middleware('permission:gestionar_usuarios');

    Route::resource('roles', RoleController::class)
        ->except(['show'])
        ->middleware('permission:gestionar_roles');

    Route::resource('permissions', PermissionController::class)
        ->except(['show'])
        ->middleware('permission:gestionar_permisos');

});
