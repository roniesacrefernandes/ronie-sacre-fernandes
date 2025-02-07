<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\BuscarRetorno;
use App\Http\Controllers\HistoricoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CsvController::class, 'index']);
Route::post('/upload', [CsvController::class, 'upload'])->name('upload');
Route::get('/buscar', [BuscarController::class, 'buscar'])->name('buscar');
Route::post('/buscarp', [BuscarController::class, 'buscarp'])->name('buscarp');
Route::get('/historico', [HistoricoController::class, 'historico'])->name('historico');
Route::post('/historicop', [HistoricoController::class, 'historicop'])->name('historicop');
