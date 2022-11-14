<?php

namespace App\Http\Resources\V1\User\Banners;

use App\Interfaces\StatusCodeable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerCollection extends ResourceCollection implements StatusCodeable
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($banner) {
            return [
                "id"    => $banner->id,
                "image" => $banner->image_url,
            ];
        });
    }

    public function statusCode(): int
    {
        return 200;
    }
}
