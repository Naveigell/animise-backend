<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        foreach (['PVC Figure', 'Nendoroid', 'Figma', 'Model Kits', 'Cds', 'Manga', 'Light Novel', 'Merchandise'] as $category) {
            $categories[] = [
                "name"       => $category,
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ];
        }

        Category::query()->insert($categories);
    }
}
