<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosEstudiante extends Model
{
    use HasFactory;

    protected $table = 'datos_estudiantes';

    public function estudiante()
    {
        return $this->hasOne( Estudiante::class, 'id', 'Id_Estudiante');
    }

    public function tipopractica()
    {
        return $this->hasOne( TipoPractica::class, 'id', 'Id_TipoPractica');
    }

    public function periodo()
    {
        return $this->hasOne( Periodo::class, 'id', 'Id_Periodo');
    }

    public function tutor()
    {
        return $this->hasOne( Tutor::class, 'id', 'Id_Tutor');
    }

    public function informe()
    {
        return $this->hasOne( Informe::class, 'id', 'Id_Informe');
    }

    public function encuesta()
    {
        return $this->hasOne( Encuesta::class, 'id', 'Id_Encuesta');
    }

}
