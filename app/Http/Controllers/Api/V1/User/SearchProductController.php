<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\User\Products\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    /**
     * @param Request $request
     * @return ProductCollection
     */
    public function index(Request $request)
    {
        $products = Product::with('category')->filter($request)->get();

        return new ProductCollection($products);
    }
}
