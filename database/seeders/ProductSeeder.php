<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    private $description = [];

    private function description()
    {
        return $this->description[array_rand($this->description)];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker    = Factory::create('id_ID');
        $products = [];

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->realTextBetween();

            $products[] = [
                "name"         => $name,
                "slug"         => \Str::slug($name),
                "description"  => $this->description(),
                "price"        => rand(2, 20) * (10 ** rand(3, 5)),
                "stock"        => rand(10, 200),
                "release_date" => rand(1, 10) < 5 ? $faker->dateTimeBetween('-2 years', '+3 months') : null,
                "created_at"   => now()->toDateTimeString(),
                "updated_at"   => now()->toDateTimeString(),
            ];
        }

        Product::query()->insert($products);
    }

    public function __construct()
    {
        $faker    = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $this->description[] = $faker->realTextBetween(1000, 2000);
        }
    }
}
