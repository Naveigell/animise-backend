<?php

namespace App\Http\Resources\V1\Products;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @property int    id
 * @property string name
 * @property string slug
 * @property string description
 * @property int    price
 * @property int    stock
 * @property string release_date
 * @property string estimated_date
 */
class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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
}
