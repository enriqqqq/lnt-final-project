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
        $admin1 = User::create([
            'name' => 'Admin First',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admintest'),
            'role' => 'admin',
            'phone_number' => '08123456789',
            'remember_token' => 'DUhA92axA',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'User One',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('usertest1'),
            'role' => 'user',
            'phone_number' => '08123456789',
            'remember_token' => '31c4gAxA',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'User Two',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('usertest2'),
            'role' => 'user',
            'phone_number' => '08123456789',
            'remember_token' => 'NbAWo9812A',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'User Three',
            'email' => 'user3@gmail.com',
            'password' => bcrypt('usertest3'),
            'role' => 'user',
            'phone_number' => '08123456789',
            'remember_token' => 'Re0cKCma1',
            'email_verified_at' => now()
        ]);
        
        User::factory(5)->create();

        User::create([
            'name' => 'Admin Second',
            'email' => 'adminsecond@gmail.com',
            'password' => bcrypt('admintest2'),
            'role' => 'admin',
            'phone_number' => '08123456789',
            'remember_token' => 'JiRwa8c7',
            'email_verified_at' => now()
        ]);

        $admins = User::where('role', 'admin')->get();
        
        foreach($admins as $index => $admin){
            AdminId::create([
                'user_id' => $admin->id,
                'admin_id' => 'ADMIN00' . $index+1
            ]);
        }
    }
}