<?php

namespace App\Http\Resources\V1\Admin\Banners;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @property mixed id
 * @property mixed image_url
 */
class BannerCollection extends ResourceCollection implements StatusCodeable
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
