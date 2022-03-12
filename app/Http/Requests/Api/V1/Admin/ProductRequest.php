<?php

namespace App\Http\Requests\Api\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "image"          => "required|image|mimes:jpg,png,jpeg",
            "name"           => "required|string|min:2|max:255",
            "description"    => "required|string|min:5|max:10000",
            "price"          => "required|integer|min:1|max:1000000000", // 1 million
            "stock"          => "required|integer|min:|max:9999",
            "release_date"   => "nullable|date",
            "estimated_date" => "nullable|date",
        ];
    }
}
