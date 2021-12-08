<?php

namespace App\Http\Resources\V1\Errors;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ValidationErrorsCollection extends ResourceCollection implements StatusCodeable
{
    use WithStatusCode;

    public static $wrap = 'errors';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection;
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode($this->statusCode());
    }

    public function statusCode(): int
    {
        return 422;
    }
}
