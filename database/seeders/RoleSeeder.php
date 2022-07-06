<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrador Técnico:
        $role1 = Role::create(['name' => 'Administrador']);
        // ---------------------------------------------------
        $role2 = Role::create(['name' => 'Subdecano']);
        $role3 = Role::create(['name' => 'Decano']);
        $role4 = Role::create(['name' => 'Coordinador CPPP']);
        $role5 = Role::create(['name' => 'Tutor']);
        $role6 = Role::create(['name' => 'Miembro CPPP']);
        $role7 = Role::create(['name' => 'Secretaria de Coordinación']);
        $role8 = Role::create(['name' => 'Usuario General']);
        $role9 = Role::create(['name' => 'Estudiante']);

        // Vista general:
        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role6, $role7, $role8, $role9]);

        // Administrador:
        Permission::create(['name' => 'usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.create'])->syncRoles([$role1]);

        // Usuarios:
        Permission::create(['name' => 'registros'])->syncRoles([$role4, $role6, $role7]);
        Permission::create(['name' => 'registros.index'])->syncRoles([$role4, $role6, $role7]);
        Permission::create(['name' => 'registros.edit'])->syncRoles([$role6, $role4, $role7]);

        // Permisos unicos:
        Permission::create(['name' => 'Fechas_Detalle'])->syncRoles([$role1]);
        Permission::create(['name' => 'Fecha_Ingreso'])->syncRoles([$role6]);
        Permission::create(['name' => 'Fecha_Certificado'])->syncRoles([$role4]);
        Permission::create(['name' => 'Fecha_Registro'])->syncRoles([$role7]);

        // Permisos Estudiantes:
        Permission::create(['name' => 'Ver Nuevos'])->syncRoles([$role9,$role2,$role3, $role4, $role5, $role6]);
        Permission::create(['name' => 'Ver Revisados'])->syncRoles([$role2, $role3, $role4, $role5, $role6]);
        Permission::create(['name' => 'Ver Rechazados'])->syncRoles([$role9, $role2, $role4, $role5, $role6]);
        Permission::create(['name' => 'Nuevo Formulario'])->syncRoles([$role9]);
        Permission::create(['name' => 'Ver Devueltos'])->syncRoles([$role9, $role2, $role4, $role5, $role6]);
        Permission::create(['name' => 'Ver Corregidos'])->syncRoles([$role9, $role2, $role4, $role5, $role6]);
        Permission::create(['name' => 'Ver Aceptados'])->syncRoles([$role9, $role4]);
    }
}
