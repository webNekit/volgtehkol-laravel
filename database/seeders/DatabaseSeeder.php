<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
            EventFormatSeeder::class,
            EventSeeder::class,
            SpecialCategorySeeder::class,
            SpecialSeeder::class,
            StaffSeeder::class,
            ManagementSeeder::class,
            ContactsSeeder::class,
        ]);
    }
}
