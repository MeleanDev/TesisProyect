<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeccionCurso extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre', 
        'apellido', 
        'telefono', 
        'correo', 
        'asunto', 
        'mensaje'
    ];
}
