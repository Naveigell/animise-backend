<?php

namespace App\Http\Resources\V1\User\Wishlist;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class WishlistCollection extends ResourceCollection implements StatusCodeable
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
        return $this->collection->transform(function ($wishlist) {
            return [
                "id"             => $wishlist->product->id,
                "name"           => $wishlist->product->name,
                "slug"           => $wishlist->product->slug,
                "price"          => $wishlist->product->price,
                "stock"          => $wishlist->product->stock,
                "release_date"   => $wishlist->product->release_date,
                "estimated_date" => $wishlist->product->estimated_date,
            ];
        });
    }

    public function statusCode(): int
    {
        return Response::HTTP_OK;
    }
}
