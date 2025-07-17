<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Se crea un nombre aleatorio
            'email' => fake()->unique()->safeEmail(), // Se crea un email único y seguro
            'email_verified_at' => now(), // Se establece la fecha de verificación del email
            'password' => static::$password ??= Hash::make('password'), // Se crea una contraseña hasheada
            'remember_token' => Str::random(10), // Se genera un token de recuerdo aleatorio
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
