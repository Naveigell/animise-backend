<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Exceptions\ProductNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\CartRequest;
use App\Http\Resources\V1\Carts\CartsCollection;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CartsCollection(Cart::with('product', 'user')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CartRequest $request
     * @param Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, Cart $cart)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
