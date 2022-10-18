<?php

namespace App\Http\Resources\V1\Biodata;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\JsonResource;

class BiodataResource extends JsonResource implements StatusCodeable
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
        $user = $this->resource;

        $user->biodata->avatar_url = $this->resource->biodata->avatar_url;

        return [
            "user" => $this->resource,
        ];
    }

    public function statusCode(): int
    {
        return 200;
    }
}
