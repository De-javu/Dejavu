<?php

namespace Database\Factories;

use App\Models\DocumentarySeries;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentarySeriesFactory extends Factory
{

    protected $model = DocumentarySeries::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3), // Se crea un nombre de serie documental aleatorio
            'user_id' => null, // Se puede asignar en el seeder
            'entity_id' => null, // Se puede asignar en el seeder
            'parent_series_id' => null,
            // Agrega aquí otros campos si tu tabla los requiere
        ];
    }
}
