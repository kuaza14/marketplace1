<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'ciudad_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function productos()
{
    return $this->hasMany(\App\Models\Producto::class, 'usuario_id');
}
    public function ciudad()
    {
        return $this->belongsTo(\App\Models\Ciudad::class, 'ciudad_id');
    }
    
    public function comentarios()
    {
        return $this->hasMany(\App\Models\Comentario::class, 'usuario_id');
    }
    
    use HasFactory;
}