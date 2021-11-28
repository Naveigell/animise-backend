<?php

namespace Database\Seeders;

use App\Models\Biodata;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker    = Factory::create('id_ID');
        $biodatas = [];

        for ($i = 1; $i <= User::query()->count(); $i++) {
            $biodatas[] = [
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
                "user_id"    => $i,
                "phone"      => $faker->unique->numerify("08##########"),
                "address"    => $faker->address . ', ' . $faker->city . ', ' . $faker->country . '.',
            ];
        }

        Biodata::query()->insert($biodatas);
    }
}
