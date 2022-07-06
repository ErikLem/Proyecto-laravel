<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'registros';

    public function datosestudiante()
    {
        return $this->hasOne( DatosEstudiante::class, 'id', 'Id_DatosEstudiante');
    }

    public function datosempresa()
    {
        return $this->hasOne( DatosEmpresa::class, 'id', 'Id_DatosEmpresa');
    }

    public function datosconvalidacion()
    {
        return $this->hasOne( DatosConvalidacion::class, 'id', 'DatosConvalidacion');
    }

    public function datosseguimiento()
    {
        return $this->hasOne( DatosSeguimiento::class, 'id', 'Id_DatosSeguimiento');
    }

}
