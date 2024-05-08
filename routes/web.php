<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienvenidaController;
use App\Http\Controllers\OfuscamientoController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\ProfileController;

Route::get('/', [BienvenidaController::class, 'iniciar'])
    ->name('bienvenida.inicio');

Route::get('/informacion', [BienvenidaController::class, 'informar'])
    ->name('bienvenida.informacion');

Route::get('/autenticacion/autenticar', [AutenticacionController::class, 'autenticar'])
    ->name('autenticacion.autenticar');

Route::post('/ofuscar', [OfuscamientoController::class, 'ofuscar'])
    ->name('ofuscamiento.ofuscar');

Route::get('/presentar', [OfuscamientoController::class, 'presentar'])
    ->name('ofuscamiento.presentar');

Route::post('/notificar_palabras_faltantes', [OfuscamientoController::class, 'notificar'])
    ->name('ofuscamiento.notificar.faltantes');

Route::get('/autenticacion/solicitar', [AutenticacionController::class, 'solicitar'])
    ->name('autenticacion.solicitar');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/autenticacion/salir', [AutenticacionController::class, 'salir'])
        ->name('autenticacion.salir');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
