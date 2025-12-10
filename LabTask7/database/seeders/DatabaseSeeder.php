<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a Test User
        // We use firstOrCreate to avoid errors if you run this command twice
        User::firstOrCreate(
            ['email' => 'test@example.com'], 
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // Password is "password"
            ]
        );

        // 2. Create Categories
        $categories = ['Technology', 'Lifestyle', 'Coding', 'Health'];
        
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }

        echo "User and Categories created successfully!\n";
    }
}