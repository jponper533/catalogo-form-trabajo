<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Formulario;

class formularioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Formulario::firstOrCreate(['datos' => '{"a": "", "b": ""}', 'username' => 'test', 'nombreForm' => 'Formulario de prueba1', 'visible' => false]);
        Formulario::firstOrCreate(['datos' => '{"a": "", "b": ""}', 'username' => 'test', 'nombreForm' => 'Formulario de prueba2', 'visible' => true]);
    }
}
