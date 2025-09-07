<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preinscripcion extends Model
{
    protected $fillable = [
        'cliente_registrado_id',
        'curso_id',
        'asunto',
        'comentario'
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
