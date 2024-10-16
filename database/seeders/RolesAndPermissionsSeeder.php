<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        /**
     * Run the database seeds.
     */
    
        // Crear permisos
        $permissions = ['create users', 'edit users', 'delete users', 'view users'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $readOnly = Role::firstOrCreate(['name' => 'read_only']);

        // Obtener todos los permisos (asegúrate de que los permisos estén correctamente creados)
        $allPermissions = Permission::all();

        // Asignar todos los permisos al rol admin
        $admin->syncPermissions($allPermissions);

        // Asignar solo el permiso de 'view users' al rol read_only
        $readOnly->syncPermissions(['view users']);
        // // Crear roles
        // $admin = Role::firstOrCreate(['name' => 'admin']);
        // $readOnly = Role::firstOrCreate(['name' => 'read_only']);

        // // Crear permisos
        // $permissions = ['create users', 'edit users', 'delete users', 'view users'];

        // foreach ($permissions as $permission) {
        //     Permission::firstOrCreate(['name' => $permission]);
        // }

        // // Asignar permisos al rol admin
        // $admin->givePermissionTo($permissions);

        // // Asignar solo el permiso de ver al rol read_only
        // $readOnly->givePermissionTo('view users');
    }
}
