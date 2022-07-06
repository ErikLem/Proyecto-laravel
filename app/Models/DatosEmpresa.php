<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosEmpresa extends Model
{
    use HasFactory;

    protected $table = 'datos_empresas';

    public function convenio()
    {
        return $this->hasOne( Convenio::class, 'id', 'Id_Convenio');
    }

    public function empresaproyecto()
    {
        return $this->hasOne( EmpresaProyecto::class, 'id', 'Id_EP');
    }

    public function tipoempresa()
    {
        return $this->hasOne( TipoEmpresa::class, 'id', 'Id_Tipo_EP');
    }

}
