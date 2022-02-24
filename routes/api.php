<?php

use App\Http\Controllers\API\CidadeController;
use Illuminate\Support\Facades\Route;

Route::get('/cidades', [CidadeController::class, 'index'])->name('api.cidades.index');
