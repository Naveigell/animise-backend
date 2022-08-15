<?php

namespace App\Http\Requests\Api\V1\User;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        $id = $this->user()->id;

        return Cart::where('user_id', $id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "proof" => "required|image|mimes:png,jpg,jpeg",
        ];
    }
}
