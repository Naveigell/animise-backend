<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Exceptions\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\CartRequest;
use App\Http\Requests\Api\V1\User\PaymentRequest;
use App\Http\Resources\V1\User\Carts\CartCollection;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CartCollection
     */
    public function index(Request $request)
    {
        return new CartCollection(Cart::with('product', 'user')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CartRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(CartRequest $request)
    {
        $product = Product::find($request->product_id);

        // throw an error if product not found
        throw_if(!$product, new ProductNotFoundException());

        // check the stock before update or create the cart
        if ($product->stock >= $request->quantity) {
            $cart = Cart::updateOrCreate([
                "user_id"    => auth()->id(),
                "product_id" => $product->id,
            ], [
                "quantity"   => $request->quantity
            ]);

            // throw if cart not saved
            throw_if(!$cart, new InternalErrorException());
        }

        return response([], 204);
    }

    public function pay(PaymentRequest $request)
    {
        \DB::transaction(function () use ($request) {

            $shipping = Shipping::create(["user_id" => $request->user()->id]);
            $carts    = Cart::where('user_id', $request->user()->id)->get();

            Payment::create(array_merge($request->validated(), [
                "shipping_id" => $shipping->id,
                "status"      => Payment::STATUS_PENDING,
            ]));

            foreach ($carts as $cart) {
                ProductOrder::create(array_merge($cart->toArray(), [
                    "shipping_id" => $shipping->id,
                    "created_at"  => now()->toDateTimeString(),
                    "updated_at"  => now()->toDateTimeString(),
                ]));

                unset($cart['product_id']);
                unset($cart['quantity']);
            }

            Cart::where('user_id', $request->user()->id)->delete();
        });

        return response([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return \response()->noContent();
    }
}
