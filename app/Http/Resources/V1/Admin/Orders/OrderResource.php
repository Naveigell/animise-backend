<?php

namespace App\Http\Resources\V1\Admin\Orders;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource implements StatusCodeable
{
    use WithStatusCode;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"       => $this->resource->id,
            "user"     => $this->resource->user,
            "payments" => $this->resource->payments->map(function ($payment) {
                return array_merge($payment->toArray(), [
                    "proof_url" => $payment->proof_url,
                ]);
            }),
            "products" => $this->resource->productOrders,
        ];
    }

    public function statusCode(): int
    {
        return 200;
    }
}
