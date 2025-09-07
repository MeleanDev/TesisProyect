<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClienteRegistrado extends Model
{
    protected $fillable = [
        'estado',
        'Pnombre',
        'Snombre',
        'Papellido',
        'Sapellido',
        'identidad',
        'email',
        'telefono',
        'image',
        'fecha_nacimiento',
    ];

    /**
     * Un ClienteRegistrado puede tener muchas preinscripciones.
     */
    public function preinscripcions(): HasMany
    {
        return $this->hasMany(Preinscripcion::class);
    }
}
