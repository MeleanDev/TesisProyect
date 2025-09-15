<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MesCantidad extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'mes',
        'cantidad'
    ];
}
