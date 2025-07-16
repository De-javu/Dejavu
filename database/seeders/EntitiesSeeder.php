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
            $users = User::all();
        Entities::factory(10)->create([
        'user_id' => $users->random()->id,
    ]);
    }
}
