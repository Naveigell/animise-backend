<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products         = Product::limit(100)->get();
        $users            = User::whereNotIn('role', [User::ROLE_ADMIN])->limit(100)->get();
        $shippingStatuses = [
            Shipping::STATUS_REJECT,
            Shipping::STATUS_SEND,
            Shipping::STATUS_PROCESS,
            Shipping::STATUS_PENDING,
        ];

        for ($i = 0; $i < 20; $i++) {
            \DB::transaction(function () use ($users, $products, $shippingStatuses) {
                    $shipping =  Shipping::create([
                        "user_id" => $users->random()->id,
                        "status"  => $shippingStatuses[array_rand($shippingStatuses)],
                    ]);

                    Payment::create([
                        "shipping_id" => $shipping->id,
                        "status"      => Payment::STATUS_PENDING,
                        "proof"       => UploadedFile::fake()->image(\Str::random() . '.jpg')
                    ]);

                    $loop = rand(3, 7);

                    for ($i = 0; $i < $loop; $i++) {

                        $product = $products->random();
                        $user    = $users->random();

                        ProductOrder::create([
                            "shipping_id" => $shipping->id,
                            "product_id"  => $product->id,
                            "user_id"     => $user->id,
                            "quantity"    => rand(1, 4),
                            "created_at"  => now()->toDateTimeString(),
                            "updated_at"  => now()->toDateTimeString(),
                        ]);
                    }
            });
        }
    }
}
