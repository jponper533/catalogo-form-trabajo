<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Datos;

class DatosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Datos::firstOrCreate(['data' => "nombre_form=EPOGRE-InformeMedico  paciente=Pepe Botella  contingencia=Gota  alta=false"]);
    }
}
