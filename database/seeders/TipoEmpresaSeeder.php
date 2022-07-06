<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoEmpresa;

class TipoEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoEmpresa::create(['Tipo_Empresa' => 'No']);
        TipoEmpresa::create(['Tipo_Empresa' => 'Interno (EPN)']);
        TipoEmpresa::create(['Tipo_Empresa' => 'ONG/Fundación']);
        TipoEmpresa::create(['Tipo_Empresa' => 'Privada']);
        TipoEmpresa::create(['Tipo_Empresa' => 'Proyecto Vinculación']);
        TipoEmpresa::create(['Tipo_Empresa' => 'Pública']);
    }
}
