<?php

namespace App\Http\Resources\V1\Admin\Products;

use App\Interfaces\StatusCodeable;
use App\Traits\Api\WithStatusCode;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection implements StatusCodeable
{
    use WithStatusCode;

    public function statusCode(): int
    {
        return 200;
    }
}
