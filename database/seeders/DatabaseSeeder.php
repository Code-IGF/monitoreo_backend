<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        //Seed Para Roles iniciales
        $roleAdmin =Role::create(['name'=>'Administrador']);
        $roleSupervisor = Role::create(['name'=>'Supervisor']);
        $roleEmpleado = Role::create(['name'=>'Empleado']);

        Permission::create(['name'=>'Usuarios.Administrar'])->assignRole($roleAdmin);
        Permission::create(['name'=>'Equipos.Administrar'])->assignRole($roleSupervisor);
        Permission::create(['name'=>'Inicio.Ver'])->assignRole($roleEmpleado);
    }
}
