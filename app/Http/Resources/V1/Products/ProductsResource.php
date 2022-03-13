<?php

namespace App\Http\Resources\V1\Products;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

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
class ProductsResource extends JsonResource implements StatusCodeable
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
            "id"             => $this->id,
            "name"           => $this->name,
            "slug"           => $this->slug,
            "description"    => $this->description,
            "price"          => $this->price,
            "stock"          => $this->stock,
            "release_date"   => $this->release_date,
            "estimated_date" => $this->estimated_date,
        ];
    }

    public function statusCode(): int
    {
        return Response::HTTP_OK;
    }
}
