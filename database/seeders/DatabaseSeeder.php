<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\AdminId;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin First',
            'email' => 'admin@gmail.com',
            'password' => 'admintest',
            'role' => 'admin',
            'remember_token' => 'DUhA92axA',
        ]);
        
        User::factory(5)->create();

        User::create([
            'name' => 'Admin Second',
            'email' => 'adminsecond@gmail.com',
            'password' => 'admintest2',
            'role' => 'admin',
            'remember_token' => 'JiRwa8c7',
        ])->each(function ($user) {
            if ($user->role === 'admin') {
                AdminId::create([
                    'user_id' => $user->id,
                    'admin_id' => 'ADMIN002',
                ]);
            }
        });
    }
}
