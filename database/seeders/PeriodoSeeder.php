<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periodo;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periodo::create(['Periodo' => '2020B']);
        Periodo::create(['Periodo' => '2021A']);
        Periodo::create(['Periodo' => '2021B']);
        Periodo::create(['Periodo' => '2022A']);
        Periodo::create(['Periodo' => '2022B']);
        Periodo::create(['Periodo' => '2023A']);
        Periodo::create(['Periodo' => '2023B']);
        Periodo::create(['Periodo' => '2024A']);
        Periodo::create(['Periodo' => '2024B']);
    }
}
