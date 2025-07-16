<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentarySeries;
use App\Models\Entities;
use App\Models\User;

class DocumentarySeriesSeeder extends Seeder
{
    public function run()
    {
        // Obtener entidades y usuarios existentes
        $entities = Entities::all();
        $users = User::all();

        // Si no hay entidades o usuarios, no crear nada
        if ($entities->isEmpty() || $users->isEmpty()) {
            return;
        }

        // Para cada entidad, crear 2 series documentales asociadas a un usuario aleatorio
        $entities->each(function ($entity) use ($users) {
            $randomUser = $users->random();
            DocumentarySeries::factory(2)->create([
                'entity_id' => $entity->id,
                'user_id' => $randomUser->id,
            ]);
        });
    }
}
