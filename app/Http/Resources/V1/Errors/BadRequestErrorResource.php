<?php

namespace App\Http\Resources\V1\Errors;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\JsonResource;

class BadRequestErrorResource extends JsonResource implements StatusCodeable
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
        return ["message" => "Bad request"];
    }

    /**
     * @inheritDoc
     */
    public function __construct($resource = [])
    {
        parent::__construct($resource);
    }

    public function statusCode(): int
    {
        return 400;
    }
}
