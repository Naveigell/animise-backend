<?php

namespace App\Http\Resources\V1\Products;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsRecommendationCollection extends ResourceCollection implements StatusCodeable
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
                "name"      => $item->name,
                "slug"      => $item->slug,
                "price"     => $item->price,
                "image"     => $item->image_url,
                "pre_order" => (boolean) $item->pre_order,
            ];
        });
    }

    public function statusCode(): int
    {
        return 200;
    }
}
