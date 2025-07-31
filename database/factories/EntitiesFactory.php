<?php

namespace Database\Factories;

use App\Models\Entities;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntitiesFactory extends Factory
{
    protected $model = Entities::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(), // Se crea un nombre de entidad aleatorio
            'user_id' => null, // Se puede asignar en el seeder
            'entity' => $this->faker->randomElement(['public','private','mixta']), // Se asigna un tipo de entidad aleatorio
            'administrative_unit' => $this->faker->company(), // Se asigna un tipo de entidad aleatorio
            'producer_office' => $this->faker->company(), // Se asigna un tipo de entidad aleatorio
        ];
    }
}
