<?php

namespace App\Http\Resources\V1\Auth;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource implements StatusCodeable
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
            "fullname" => $this->name,
            "username" => $this->username,
        ];
    }

    public function statusCode(): int
    {
        return 201;
    }
}
