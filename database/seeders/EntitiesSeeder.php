<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Entities;
use App\Models\DocumentarySeries;

class EntitiesSeeder extends Seeder
{
    public function run()
    {
            $users = User::all(); // Obtener todos los usuarios existentes
        Entities::factory(10)->create([ // Crear 10 entidades
        'user_id' => $users->random()->id,// Asignar un usuario aleatorio a cada entidad
    ]);
    }
}
