<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'valor',
        'imagen',
        'estado_producto',
        'estado',
        'categoria_id',
        'usuario_id',
        'ciudad_id',
    ];
}
