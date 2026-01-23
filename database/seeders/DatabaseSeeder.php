<?php

namespace Database\Seeders;

use App\Models\Error;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Error::factory(20)->create([
            'user_id' => $user->id,
        ]);

        User::factory(5)->hasErrors(3)->create();
    }
}
