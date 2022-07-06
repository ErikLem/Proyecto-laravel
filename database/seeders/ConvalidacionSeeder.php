<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Convalidacion;

class ConvalidacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Convalidacion::create(['Convalidacion' => 'Sí']);
        Convalidacion::create(['Convalidacion' => 'No']);
    }
}
