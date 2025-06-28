<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CiudadesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\loginController;

use App\Models\Categoria;
use Illuminate\Http\Ciudad;
use Illuminate\Http\Producto;
use Illuminate\Http\Comentarios;
use Illuminate\Http\Usuario;

Route::get('/', function (){
    if (Auth::check()) 
        return redirect('home');
    
    return view('login');
    
});

Route::get('/', function () {
    if (Auth::check()) 
        return redirect('home');

    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::get('/terminos-condiciones', function () {
    return view('terminos');
});

Route::get('/home', function () {
    return view('home'); // asegurarte de tener la vista creada
});

Route::post('register', [logincontroller::class, 'register']);
Route::post('check', [logincontroller::class, 'check']);

Route::middleware(['auth'])->group(function () {

        Route::get('/home', function () {
            return view('home'); // asegurarte de tener la vista creada
        });

        Route::get('logout', [logincontroller::class, 'logout']);


        Route::resource('categoria', CategoriaController::class);
        Route::resource('ciudad', CiudadesController::class);
        Route::resource('producto', ProductosController::class);
        Route::resource('comentario', ComentariosController::class);
        Route::resource('usuario', UsuariosController::class);


    });