<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Models\Categoria;

Route::get('/', function () {
    return view('layout');
});

Route::resource('categoria', CategoriaController::class);