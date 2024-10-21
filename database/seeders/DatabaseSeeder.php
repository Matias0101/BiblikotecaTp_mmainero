<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash; //  importar Hash para encriptar la contraseña

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar al seeder de roles y permisos antes de crear el usuario, para asegurarse de que los roles estén disponibles
       // $this->call(RolesAndPermissionsSeeder::class);

        // Verificar si ya existe un usuario con este correo
        $existingUser = User::where('email', 'admin@gmail.com')->first();

        if (!$existingUser) {
            // Crear un usuario administrador si no existe
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('www000jus'),
            ]);

            // Asignar el rol de admin al usuario recién creado
            $adminUser->assignRole('admin');
        }

        // Podés seguir creando más usuarios si lo necesitás
        // User::factory(10)->create();
        // Crear un usuario administrador con el correo y contraseña proporcionados
          // Verificar si ya existe un usuario con este correo
        //   $existingUser = User::where('email', 'admin@gmail.com')->first();

        //   if (!$existingUser) {
        //       // Crear un usuario administrador si no existe
        //       User::factory()->create([
        //           'name' => 'Admin User',
        //           'email' => 'admin@gmail.com',
        //           'password' => Hash::make('www000jus'),
        //       ]);
        //   }

        
        //  // Llamar al seeder de roles y permisos
        // $this->call(RolesAndPermissionsSeeder::class);

        // Podés seguir creando más usuarios si lo necesitás
        // User::factory(10)->create();
    }
}