<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Curso extends Model
{
    protected $fillable = [
        'estado',
        'image',
        'slug',
        'nombre',
        'descripcion',
        'precio',
        'horasAcademicas',
        'maximoParticipantes',
        'modalidad',
        'certificacion',
        'tipoCurso',
        'categoria',
        'idioma',
    ];
    
    public function preinscripcions(): HasMany
    {
        return $this->hasMany(Preinscripcion::class);
    }

    public function certificacion(): HasMany
    {
        return $this->hasMany(Certificacion::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? asset('storage/' . $this->image) : asset('path/to/default-image.png'),
        );
    }
}
