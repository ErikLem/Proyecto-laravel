<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Informe;

class InformeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Informe::create(['Informe' => 'En proceso']);
        Informe::create(['Informe' => 'No aplica']);
        Informe::create(['Informe' => 'Sí']);
    }
}
