<?php

namespace Database\Seeders;

use App\Models\Admin\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $imageUrls = [];
        for ($i = 0; $i < 20; $i++) {
            $imageUrls[] = $faker->imageUrl();
            Product::create([
                'user_id' => '1',
                'category_id' => $faker->numberBetween(133,143),
                'name' => $faker->name,
                'slug' => $faker->slug,
                'description' => $faker->paragraph,
                'thumbnail' => $faker->imageUrl(),
                'images' => json_encode($imageUrls),
                'shipping_day' => $faker->numberBetween(1,7),
                'free_shipping_status' => $faker->boolean(),
                'flat_rate' => $faker->randomFloat(2, 0, 20),
                'cash_on_delivery_status' => $faker->boolean,
                'warning_quantity' => $faker->numberBetween(0, 20),
                'show_stock_quantity' => $faker->boolean,
                'show_stock_text' => $faker->boolean,
                'hide_stock' => $faker->boolean,
                'featured' => $faker->boolean,
                'todays_deal' => $faker->boolean,
                'unit_price' => $faker->randomFloat(2, 5, 200),
                'discount_date' => $faker->dateTimeThisMonth(),
                'discount_price' => $faker->randomFloat(2, 1, 50),
                'quantity' => $faker->numberBetween(0, 100),
            ]);
        }
    }
}
