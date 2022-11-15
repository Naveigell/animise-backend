<?php

namespace App\Http\Resources\V1\User\Products;

use App\Interfaces\StatusCodeable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ProductCollection extends ResourceCollection implements StatusCodeable
{
    /**
     * Transform the resource collection into an array.
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
