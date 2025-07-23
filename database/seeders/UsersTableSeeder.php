<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Crea 10 usuarios de ejemplo
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'andrespardo5151@gmail.com',
            'password' => bcrypt('Casa12345'),

        ]);

        User::factory()->create([
            'name' => 'Thomas Moreno',
            'email' => 'thomas@moreno.com',
            'password' => bcrypt('Casa12345'),

        ]);
    }
}
