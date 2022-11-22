<?php

namespace App\Http\Resources\V1\User\Carts;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection implements StatusCodeable
{
    use WithStatusCode;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
            return [
                "id"        => $item->id,
                "quantity"  => $item->quantity,
                "product"   => $item->product,
            ];
        });
    }

    public function statusCode(): int
    {
        return 200;
    }
}
