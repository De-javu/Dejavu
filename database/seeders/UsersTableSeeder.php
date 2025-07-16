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
    }
}
