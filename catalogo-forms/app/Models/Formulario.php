<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $fillable = ['datos', 'username', 'nombreForm', 'visible'];

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'formulario_id');
    }
}
