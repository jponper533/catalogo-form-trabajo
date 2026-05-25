<?php

namespace App\Services;

use App\Models\Favorito;
use App\Models\Formulario;

class favoritoService {

    public function crearFavorito(): Favorito 
    {
        return Favorito::create([
            'formulario_id' => Formulario::latest()->first()->id,
            'username' => session('username'),
        ]);;
    }
}
