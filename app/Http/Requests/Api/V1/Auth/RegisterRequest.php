<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"     => "required|string|min:3|max:255",
            "username" => "required|string|min:3|max:255",
            "password" => "required|string|min:6|max:255",
            "phone"    => "required|string|min:7|max:17",
            "address"  => "required|string|min:6|max:350",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "username" => str_replace(' ', '', $this->get('username', '')),
        ]);
    }
}
