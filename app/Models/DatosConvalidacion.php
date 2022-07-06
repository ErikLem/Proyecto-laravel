<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosConvalidacion extends Model
{
    use HasFactory;


    protected $table = 'datos_convalidacions';
    
    protected $fillable = ['Detalle'];

    public function convalidacion()
    {
        return $this->hasOne( Convalidacion::class, 'id', 'Id_Convalidacion');
    }

    public function tipoconvalidacion()
    {
        return $this->hasOne( TipoConvalidacion::class, 'id', 'Id_Tipo_Convalidacion');
    }

}
