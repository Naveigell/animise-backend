<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\ProductImage;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [];

        \File::ensureDirectoryExists(storage_path('app/public/images/banners'));

        for ($i = 0; $i < 6; $i++) {
            Banner::query()->create([
                "image"      => UploadedFile::fake()->image(\Str::random() . '.jpg'),
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ]);
        }
    }
}
