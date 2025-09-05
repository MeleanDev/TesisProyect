<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

Route::controller(WebsiteController::class)->group(function () {
    Route::get('/', 'inicio')->name('inicio');
    Route::get('/contacto', 'contacto')->name('contacto');
    Route::post('/contacto', 'formContacto');
    Route::get('/preinscripcion', 'preinscripcion')->name('preinscripcion');

    route::prefix('cursos')->group(function () {
        Route::get('/curso-empresa', 'cursoEmpresa')->name('cursoEmpresa');
        Route::get('/curso-ejecutivo', 'cursoEjecutivo')->name('cursoEjecutivo');
        Route::get('/curso-menor', 'cursoMenor')->name('cursoMenor');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
