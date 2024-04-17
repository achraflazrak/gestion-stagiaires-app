<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'cin' => 'AA000111',
            'nom' => 'lazrak',
            'prenom' => 'achraf',
            'email' => 'achraflazrak@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'is_admin' => true,
            'remember_token' => Str::random(10),
        ]);
    }
}
