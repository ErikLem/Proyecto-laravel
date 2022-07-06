<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoPractica;

class TipoPracticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPractica::create(['TipoPracticas' => 'Servicio Comunitario']);
        TipoPractica::create(['TipoPracticas' => 'Práctica Laboral']);
    }
}
