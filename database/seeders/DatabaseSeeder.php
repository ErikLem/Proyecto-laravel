<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ConvalidacionSeeder::class);
        $this->call(ConvenioSeeder::class);
        $this->call(EncuestaSeeder::class);
        $this->call(InformeSeeder::class);
        $this->call(PeriodoSeeder::class);
        $this->call(TipoConvalidacionSeeder::class);
        $this->call(TipoEmpresaSeeder::class);
        $this->call(TipoPracticaSeeder::class);
    }
}
