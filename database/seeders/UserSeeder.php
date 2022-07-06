<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // USUARIO ADMINISTRADOR
        User::create([
            'name' => 'Danny Alexander Juela Banshuy',
            'email' => 'administrador@epn.edu.ec',
            'username' => '201523158',
            'password' => bcrypt('password')
        ])->assignRole('Administrador');
        // USUARIO SUBDECANO
        User::create([
            'name' => 'Erick Lema',
            'email' => 'subdecano@epn.edu.ec',
            'username' => '201620104',
            'password' => bcrypt('password')
        ])->assignRole('Subdecano');
        // USUARIO TUTOR (Temporar es solo para pruebas)
        User::create([
            'name' => 'Jorge Perez',
            'email' => 'tutor@epn.edu.ec',
            'username' => '201510203',
            'password' => bcrypt('password')
        ])->assignRole('Tutor');
        
        $profesor = new Profesor();
        $profesor->cedula = '1728089475';
        $profesor->correo = 'jorge.perez@epn.edu.ec';
        $profesor->epn = '201510203';

        $profesor->departamento = 'TELECOMUNICACIONES';
        $profesor->nombres = 'JORGE';
        $profesor->apellidos = 'PEREZ';
        $profesor->telefono = '2365698';
        $profesor->celular = '0981256241';   
        $profesor->user_id = 70;

        $profesor->save();

        // USUARIO ESTUDIANTE NUEVO (Temporar es solo para pruebas)
        User::create([
            'name' => 'JUAN MARTINEZ',
            'email' => 'estudiante@epn.edu.ec',
            'username' => '201610215',
            'password' => bcrypt('password')
        ])->assignRole('Estudiante');
        
        $estudiante = new Estudiante();
                $estudiante->cedula = '0508096475';
                $estudiante->correo = 'juan.martinez@epn.edu.ec';
                $estudiante->epn = '201610215';
        
                $estudiante->carrera = 'TELECOMUNICACIONES';
                $estudiante->nombres = 'JUAN';
                $estudiante->apellidos = 'MARTINEZ';
                $estudiante->telefono = '236598';
                $estudiante->celular = '0987356241';   
                $estudiante->user_id = 71;
        
                $estudiante->save();

        // USUARIO DECANO
        User::create([
            'name' => 'Diego Jacome',
            'email' => 'decano@epn.edu.ec',
            'username' => '201320203',
            'password' => bcrypt('password')
        ])->assignRole('Decano');
        // USUARIO DIRECTORA DE LA CPP
        User::create([
            'name' => 'Patricia Cifuentes',
            'email' => 'coordinadorcpp@epn.edu.ec',
            'username' => '201223215',
            'password' => bcrypt('password')
        ])->assignRole('Coordinador CPPP');
        // USUARIO MIEBRO DE LA COMISION
         User::create([
            'name' => 'JOSE ADRIAN ZAMBRANO',
            'email' => 'miembrocpp@epn.edu.ec',
            'username' => '201223987',
            'password' => bcrypt('password')
        ])->assignRole('Miembro CPPP');
    }
}
