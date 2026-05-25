<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    protected $table = 'datos';

    protected $fillable = [
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
