<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama a los seeders de cada tabla relevante
        $this->call([
            // Si tienes más seeders, agrégalos aquí
            UsersTableSeeder::class,
            EntitiesSeeder::class,
            DocumentarySeriesSeeder::class,
            // Agrega aquí otros seeders como RolesSeeder, QueriesSeeder, etc.
        ]);
    }
}
