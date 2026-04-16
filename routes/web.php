<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotaFiscalController;

Route::get('/', [NotaFiscalController::class, 'index']);
Route::post('/processar', [NotaFiscalController::class, 'processar']);
Route::get('/notas', [NotaFiscalController::class, 'listar'])->name('notas.index');
Route::get('/notas/{nota}', [NotaFiscalController::class, 'show'])->name('notas.show');

//Route::get('/', function () {
    //return view('welcome');
//});
