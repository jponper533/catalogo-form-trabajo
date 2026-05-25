<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\FavoritoController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['ldap.auth'])->group(function () {
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('formulario', FormularioController::class);
Route::resource('favorito', FavoritoController::class);

Route::post('/formulario/{formulario}/activar', [FormularioController::class, 'activar'])->name('formulario.activar');
Route::post('/favorito/{favorito}/toggle', [FavoritoController::class, 'toggle'])->name('favorito.toggle');
Route::get('/mis-formularios', [FormularioController::class, 'seeUserForms'])->name('formulario.seeUserForms');
Route::get('/formulario/{formulario}/json',[FormularioController::class, 'show'])->name('formulario.formularioJSON');
});