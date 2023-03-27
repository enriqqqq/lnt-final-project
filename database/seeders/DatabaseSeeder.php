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
            'password' => bcrypt('admintest'),
            'role' => 'admin',
            'remember_token' => 'DUhA92axA',
        ]);

        User::create([
            'name' => 'User One',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('usertest1'),
            'role' => 'user',
            'remember_token' => '31c4gAxA',
        ]);

        User::create([
            'name' => 'User Two',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('usertest2'),
            'role' => 'user',
            'remember_token' => 'NbAWo9812A',
        ]);

        User::create([
            'name' => 'User Three',
            'email' => 'user3@gmail.com',
            'password' => bcrypt('usertest3'),
            'role' => 'user',
            'remember_token' => 'Re0cKCma1',
        ]);
        
        User::factory(5)->create();

        User::create([
            'name' => 'Admin Second',
            'email' => 'adminsecond@gmail.com',
            'password' => bcrypt('admintest2'),
            'role' => 'admin',
            'remember_token' => 'JiRwa8c7',
        ])->each(function ($user) {
            if($user->role === 'admin') {
                AdminId::create([
                    'user_id' => $user->id,
                    'admin_id' => 'ADMIN002',
                ]);
            }
        });
    }
}