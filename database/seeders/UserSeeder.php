<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $users = [
            [
                "name"       => "Admin Animise",
                "username"   => "admin.animise",
                "email"      => "admin.animise@gmail.com",
                "password"   => 123456,
                "role"       => "admin",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ],
            [
                "name"       => "Customer Animise",
                "username"   => "customer.animise",
                "email"      => "customer.animise@gmail.com",
                "password"   => 123456,
                "role"       => "customer",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ],
        ];

        for ($i = 0; $i < 20; $i++) {
            $users[] = [
                "name"       => $faker->name,
                "username"   => $faker->unique->userName,
                "email"      => $faker->unique->email,
                "password"   => 123456,
                "role"       => $this->role($i),
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ];
        }

        User::query()->insert($users);
    }

    private function role($index)
    {
        return $index < 5 ? "admin" : "customer";
    }
}
