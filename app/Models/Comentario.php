<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'descripcion',
        'estado',
        'valoracion',
        'producto_id',
        'usuario_id',
    ];

}
