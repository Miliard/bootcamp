<?php

// Importar controladores que se van a utilizar
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use App\Models\Chirp;
use Illuminate\Support\Facades\Route;

// Página de inicio pública
Route::view('/', 'welcome')->name('welcome');

// Grupo de rutas que requieren autenticación
Route::middleware('auth')->group(function () {

  // Vista del dashboard privado
  Route::view('/dashboard', 'dashboard')->name('dashboard');

  // Rutas para el perfil del usuario autenticado
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // Rutas para los chirps
  Route::get('/chirps',[ChirpController::class, 'index'] )->name('chirps.index');
  Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');

  Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'] )->name('chirps.edit');

  Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');

  Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.destroy');
});

// Importar rutas de autenticación
require __DIR__.'/auth.php';
