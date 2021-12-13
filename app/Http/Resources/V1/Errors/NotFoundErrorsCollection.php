<?php

namespace App\Http\Resources\V1\Errors;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotFoundErrorsCollection extends ResourceCollection implements StatusCodeable
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

    public function statusCode() : int
    {
        return 404;
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(404);

        parent::withResponse($request, $response);
    }
}
