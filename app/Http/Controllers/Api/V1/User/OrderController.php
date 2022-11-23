<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\User\Order\OrderCollection;
use App\Models\ProductOrder;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderCollection
     */
    public function index(Request $request)
    {
        $shippings = Shipping::with('productOrders.product', 'payments', 'user.biodata')->where('user_id', $request->user()->id)->get();

        return new OrderCollection($shippings);
    }
}
