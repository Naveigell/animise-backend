<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [];

        for ($i = 1; $i <= Product::query()->count(); $i++) {
            for ($j = 0; $j < rand(1, 3); $j++) {
                $images[] = [
                    "product_id" => $i,
                    "name"       => UploadedFile::fake()->image(\Str::random() . '.jpg'),
                    "created_at" => now()->toDateTimeString(),
                    "updated_at" => now()->toDateTimeString(),
                ];
            }
        }

        ProductImage::query()->insert($images);
    }
}
