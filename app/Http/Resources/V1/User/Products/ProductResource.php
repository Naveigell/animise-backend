<?php

namespace App\Http\Resources\V1\User\Products;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @property int     id
 * @property string  name
 * @property string  description
 * @property string  slug
 * @property int     price
 * @property int     stock
 * @property string  release_date
 * @property string  estimated_date
 * @property boolean pre_order
 */
class ProductResource extends JsonResource implements StatusCodeable
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
            "pre_order"      => (boolean) $this->pre_order,
        ];
    }

    public function statusCode(): int
    {
        return Response::HTTP_OK;
    }
}
