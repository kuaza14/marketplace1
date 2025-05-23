<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CiudadesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\UsuariosController;
use App\Models\Categoria;
use Illuminate\Http\Ciudad;
use Illuminate\Http\Producto;
use Illuminate\Http\Comentarios;
use Illuminate\Http\Usuario;



Route::get('/', function () {
    return view('layout');
});

Route::resource('categoria', CategoriaController::class);
Route::resource('ciudad', CiudadesController::class);
Route::resource('producto', ProductosController::class);
Route::resource('comentario', ComentariosController::class);
Route::resource('usuario', UsuariosController::class);


