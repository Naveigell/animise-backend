<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\ProductImage;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Factory::create();
        $images = [];

        \File::ensureDirectoryExists(storage_path('app/public/images/banners'));

        for ($i = 0; $i < 6; $i++) {
            $images[] = [
                "image"      => $faker->image(storage_path('app/public/images/banners'), 640, 640, null, false),
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ];
        }

        Banner::query()->insert($images);
    }
}
