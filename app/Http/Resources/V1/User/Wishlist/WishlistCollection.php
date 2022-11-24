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
        return parent::toArray($request);
    }

    public function statusCode(): int
    {
        return Response::HTTP_OK;
    }
}
