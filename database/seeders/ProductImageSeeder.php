<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $images = [];

        for ($i = 1; $i <= Product::query()->count(); $i++) {
            for ($j = 0; $j < rand(1, 3); $j++) {
                $images[] = [
                    "product_id" => $i,
                    "name"       => $faker->image(storage_path('app/public/images/products'), 640, 640, null, false),
                    "created_at" => now()->toDateTimeString(),
                    "updated_at" => now()->toDateTimeString(),
                ];
            }
        }

        ProductImage::query()->insert($images);
    }
}
