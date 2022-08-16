<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Exceptions\BadRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\ShippingRequest;
use App\Http\Resources\V1\Admin\Orders\OrderCollection;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderCollection
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        throw_if(!in_array($status, [
            Shipping::STATUS_PENDING,
            Shipping::STATUS_PROCESS,
            Shipping::STATUS_REJECT,
            Shipping::STATUS_SEND,
        ]), new BadRequestException());

        $shippings = Shipping::with('payments', 'productOrders.product', 'user')->where('status', $status)->get();

        return new OrderCollection($shippings);
    }

    /**
     * @param ShippingRequest $request
     * @param Shipping $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, Shipping $shipping)
    {
        $shipping->update(["status" => $request->status]);

        return response()->noContent();
    }

}
