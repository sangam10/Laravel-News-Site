<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Menu;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        News::factory(10)->create();

        User::create([
            'name' => 'Sangam Rimal',
            'email' => 'sangamrimal4@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('sangamrimal'),
        ]);
        Category::create([
            'category_name' => 'Sports',
        ]);
        Category::create([
            'category_name' => 'Politics',
        ]);
        Category::create([
            'category_name' => 'Entertainment',
        ]);
        Category::create([
            'category_name' => 'International',
        ]);
        Menu::create([
            'name' => 'main_menu',
            'body' => '1,2,3',
        ]);
    }
}
