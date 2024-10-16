<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; //  importar Hash para encriptar la contraseña

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario administrador con el correo y contraseña proporcionados
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('www000jus'), // Encriptar la contraseña
        ]);

        // Podés seguir creando más usuarios si lo necesitás
        // User::factory(10)->create();
    }
}