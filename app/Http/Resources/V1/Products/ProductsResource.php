<?php

namespace App\Http\Resources\V1\Products;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\JsonResource;

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
            "id"           => $this->id,
            "name"         => $this->name,
            "slug"         => $this->slug,
            "description"  => $this->description,
            "price"        => $this->price,
            "stock"        => $this->stock,
            "release_date" => $this->release_date,
        ];
    }

    public function statusCode(): int
    {
        return 200;
    }
}
