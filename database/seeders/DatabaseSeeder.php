<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Entities\UserEntity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\UserEntity::factory(10)->create();

         UserEntity::create([
             'name' => 'Administrator',
             'email' => 'admin@example.com',
             'password' => Hash::make('123456'),
             'is_admin' => true
         ]);

        UserEntity::create([
            'name' => 'User1 Test',
            'email' => 'user1@example.com',
            'password' => Hash::make('123456'),
        ]);

        UserEntity::create([
            'name' => 'User2 Test',
            'email' => 'user1@example.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
