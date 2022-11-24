<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\WishlistRequest;
use App\Http\Resources\V1\User\Wishlist\WishlistCollection;
use App\Http\Resources\V1\User\Wishlist\WishlistResource;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return WishlistCollection
     */
    public function index(Request $request)
    {
        $wishlists = Wishlist::with('product.category')->where('user_id', $request->user()->id)->get();

        return new WishlistCollection($wishlists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WishlistRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WishlistRequest $request)
    {
        $wishlist = Wishlist::query()->where([
            "user_id"    => $request->user()->id,
            "product_id" => $request->product_id,
        ])->first();

        // if wishlist of this user doesn't exists
        if (!$wishlist) {
            Wishlist::query()->create([
                "user_id"    => $request->user()->id,
                "product_id" => $request->product_id,
            ]);
        } else {
            $wishlist->delete();
        }

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $productId
     * @return Response
     */
    public function show(Request $request, $productId)
    {
        $product = Wishlist::where('user_id', $request->user()->id)->where('product_id', $productId)->first();

        return WishlistResource::make($product);
    }
}
