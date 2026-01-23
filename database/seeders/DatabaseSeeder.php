<?php

namespace Database\Seeders;

use App\Models\ErrorMessage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        ErrorMessage::factory(20)->create([
            'user_id' => $user->id,
        ]);

        User::factory(5)->hasErrorMessages(3)->create();
    }
}
