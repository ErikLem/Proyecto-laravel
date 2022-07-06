<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoConvalidacion;

class TipoConvalidacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoConvalidacion::create(['Tipo_Convalidacion' => 'No']);
        TipoConvalidacion::create(['Tipo_Convalidacion' => 'Experiencia Laboral']);
        TipoConvalidacion::create(['Tipo_Convalidacion' => 'Actividades extracurriculares']);
    }
}
