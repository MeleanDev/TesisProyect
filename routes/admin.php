<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('Sistema')->group(function () {
    
    Route::controller(dashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });

    Route::controller(ClienteController::class)->group(function () {
        Route::get('/cliente', 'index')->name('cliente');
        Route::get('/cliente/lista', 'lista');
        Route::get('/cliente/detalle/{id}', 'detalle');
        Route::post('/cliente', 'guardar');
        Route::post('/cliente/editar/{id}', 'editar');
        Route::delete('/cliente/{id}', 'eliminar');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/administrador', 'index')->name('administrador');
        Route::get('/administrador/lista', 'lista');
        Route::get('/administrador/detalle/{id}', 'detalle');
        Route::post('/administrador', 'guardar');
        Route::post('/administrador/editar/{id}', 'editar');
        Route::delete('/administrador/{id}', 'eliminar');
    });



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
