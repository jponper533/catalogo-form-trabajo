<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatosController;

Route::get('/', [DatosController::class, 'index'])->name('main.index');

Route::resource('datos', DatosController::class)->only(['store']);

Route::post('/buscar', [DatosController::class, 'buscar'])->name('datos.buscar');

Route::get('/export-resultados', [DatosController::class, 'export'])
    ->name('export.resultados');

