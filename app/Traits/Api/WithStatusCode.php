<?php

namespace App\Traits\Api;

trait WithStatusCode
{
    public function with($request)
    {
        if (!method_exists($this, 'statusCode')) {
            return parent::with($request);
        }

        return [
            "code" => $this->statusCode(),
        ];
    }
}
