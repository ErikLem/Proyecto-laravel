<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Convenio;

class ConvenioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Convenio::create(['Convenio' => 'En proceso']);
        Convenio::create(['Convenio' => 'Sí']);
        Convenio::create(['Convenio' => 'No']);
    }
}
