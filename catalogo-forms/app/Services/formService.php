<?php

namespace App\Services;

use App\Models\Formulario;

class formService {

    public function crearFormulario(array $datos): Formulario 
    {
        return Formulario::create($datos);
    }
}