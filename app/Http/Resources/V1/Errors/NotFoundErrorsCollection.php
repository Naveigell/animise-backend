<?php

namespace App\Http\Resources\V1\Errors;

use App\Interfaces\StatusCodeable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotFoundErrorsCollection extends ResourceCollection implements StatusCodeable
{
    public static $wrap = 'errors';

    public function with($request)
    {
        return [
            "code" => $this->statusCode(),
        ];
    }

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

    public function statusCode() : int
    {
        return 404;
    }
}
