<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $fillable = ['carrera', 'nombres', 'apellidos', 'cedula', 'correo', 'telefono', 'celular', 'epn'];
    use HasFactory;
}
