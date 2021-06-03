<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\InicioController;

Route::get('/', InicioController::class)->name('inicio');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::get('/establecimiento/create', [EstablecimientoController::class, 'create'])->name('establecimiento.create');
    Route::post('/establecimiento', [EstablecimientoController::class, 'store'])->name('establecimiento.store');
    Route::get('/establecimiento/edit', [EstablecimientoController::class, 'edit'])->name('establecimiento.edit');
    Route::post('/imagenes/store', [ImagenController::class, 'store'])->name('imagenes.store');
    Route::post('/imagenes/destroy', [ImagenController::class, 'destroy'])->name('imagenes.destroy');
});


