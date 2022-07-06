<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Encuesta;

class EncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Encuesta::create(['Encuesta' => 'En proceso']);
        Encuesta::create(['Encuesta' => 'Falta']);
        Encuesta::create(['Encuesta' => 'No']);
        Encuesta::create(['Encuesta' => 'No Aplica']);
        Encuesta::create(['Encuesta' => 'Sí']);
    }
}
