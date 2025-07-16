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
            'name' => $this->faker->company(),
            'user_id' => null, // Se puede asignar en el seeder
            'entity' => $this->faker->randomElement(['public', 'private']),
            'administrative_unit' => $this->faker->word(),
            'producer_office' => $this->faker->companySuffix(),
        ];
    }
}
