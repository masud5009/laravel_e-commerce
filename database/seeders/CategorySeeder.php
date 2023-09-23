<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            Category::create([
                'name' => $faker->name,
                'slug' => $faker->slug,
                'description' => $faker->paragraph,
                'icon' => $faker->imageUrl(),
                'cover_img' => $faker->imageUrl(),
                'banner' => $faker->imageUrl(),
            ]);
        }
    }
}
