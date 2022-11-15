<?php

namespace App\Http\Requests\Api\V1\Admin;

use App\Models\Category;
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
        $categoryIds = Category::query()->pluck('id')->join(',');

        return [
            "category_id"    => "required|integer|min:1|in:{$categoryIds}",
            "image"          => "required|image|mimes:jpg,png,jpeg",
            "name"           => "required|string|min:2|max:255",
            "description"    => "required|string|min:5|max:10000",
            "price"          => "required|integer|min:1|max:1000000000", // 1 million
            "stock"          => "required|integer|min:|max:9999",
            "release_date"   => "nullable",
            "estimated_date" => "nullable",
            "pre_order"      => "nullable|in:0,1",
        ];
    }
}
