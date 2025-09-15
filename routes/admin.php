<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CertificadoController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\PreinscripcionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('Sistema')->group(function () {

    Route::controller(dashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });

    Route::controller(ClienteController::class)->group(function () {
        Route::get('cliente', 'index')->name('cliente');
        Route::get('cliente/lista', 'lista');
        Route::get('cliente/detalle/{id}', 'detalle');
        Route::post('cliente', 'guardar');
        Route::post('cliente/editar/{id}', 'editar');
        Route::delete('cliente/{id}', 'eliminar');
    });

    Route::controller(CursoController::class)->group(function () {
        Route::get('cursos', 'index')->name('cursos');
        Route::get('cursos/lista', 'lista');
        Route::get('cursos/detalle/{id}', 'detalle');
        Route::post('cursos', 'guardar');
        Route::post('cursos/editar/{id}', 'editar');
        Route::delete('cursos/{id}', 'eliminar');
    });

    Route::controller(PreinscripcionController::class)->group(function () {
        Route::get('preinscripciones', 'index')->name('preinscripciones');
        Route::get('preinscripciones/lista', 'lista');
        Route::post('preinscripciones/aceptar/{id}', 'aceptar');
        Route::post('preinscripciones/anular/{id}', 'anular');
    });

    Route::controller(CertificadoController::class)->group(function () {
        Route::get('certificados', 'index')->name('certificados');
        Route::get('certificados/lista', 'lista');
        Route::get('certificados/detalle/{id}', 'detalle');
        Route::post('certificados', 'guardar');
        Route::post('certificados/editar/{id}', 'editar');
        Route::delete('certificados/{id}', 'eliminar');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('administrador', 'index')->name('administrador');
        Route::get('administrador/lista', 'lista');
        Route::get('administrador/detalle/{id}', 'detalle');
        Route::post('administrador', 'guardar');
        Route::post('administrador/editar/{id}', 'editar');
        Route::delete('administrador/{id}', 'eliminar');
    });



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
