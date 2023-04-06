<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\AdminId;
use \App\Models\Item;
use \App\Models\Category;

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
            'image' => '1680779580_paull.jpg',
            'remember_token' => 'DUhA92axA',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'User One',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('usertest1'),
            'role' => 'user',
            'phone_number' => '08123456789',
            'image' => '1680782320_Tony_Stark.webp',
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

        // id: 1
        Category::create([
            'name' => 'Electronics'
        ]);

        // id: 2
        Category::create([
            'name' => 'Clothing'
        ]);

        // id: 3
        Category::create([
            'name' => 'Pets'
        ]);

        // id: 4
        Category::create([
            'name' => 'Food'
        ]);

        Item::create([
            'name' => 'Red Toy Poodle',
            'category_id' => 3,
            'price' => 1500000,
            'stock' => 5,
            'image' => '1680782583_paulsleep.jpg'
        ]);

        Item::create([
            'name' => 'ASUS Laptop',
            'category_id' => 1,
            'price' => 1000000,
            'stock' => 50,
            'image' => '1680782847_asus_laptop.png'
        ]);

        Item::create([
            'name' => 'Logitech Mouse',
            'category_id' => 1,
            'price' => 550000,
            'stock' => 50,
        ]);

        Item::create([
            'name' => 'Speaker',
            'category_id' => 1,
            'price' => 200000,
            'stock' => 20,
            'image' => '1680783014_speaker.jpg'
        ]);

        Item::create([
            'name' => 'Tony  Stark Face Graphic T-Shirt',
            'category_id' => 2,
            'price' => 150000,
            'stock' => 170,
            'image' => '1680783192_men-tony-stark-face-graphic-t-shirt-1000x1000.webp'
        ]);

        Item::create([
            'name' => 'Red Jacket',
            'category_id' => 2,
            'price' => 100000,
            'stock' => 280,
        ]);

        Item::create([
            'name' => 'Bakmi',
            'category_id' => 4,
            'price' => 15000,
            'stock' => 990,
            'image'  => '1680783374_bakmi.jpg'
        ]);
    }
}