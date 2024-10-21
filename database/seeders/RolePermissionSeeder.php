<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $readOnlyRole = Role::create(['name' => 'read_only']);

        // Crear permisos (aquí puedes agregar más permisos según tus necesidades)
        $permission1 = Permission::create(['name' => 'view articles']);
        $permission2 = Permission::create(['name' => 'edit articles']);
        $permission3 = Permission::create(['name' => 'publish articles']);

        // Asignar permisos al rol admin
        $adminRole->givePermissionTo([$permission1, $permission2, $permission3]);

        // Asignar permisos al rol read_only (solo ver artículos en este caso)
        $readOnlyRole->givePermissionTo($permission1);
    }
}
