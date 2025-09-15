<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificacion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'cliente_registrado_id',
        'curso_id',
        'ruta',
        'codigo'
    ];

    public function clienteRegistrado(): BelongsTo
    {
        return $this->belongsTo(ClienteRegistrado::class);
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }
}
