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
            "name"     => "required|string|min:1|max:30",
            "username" => "required|string|min:6|max:20",
            "password" => "required|string|min:6|max:20",
            "phone"    => "required|string|min:7|max:13",
            "address"  => "required|string|min:1|max:30",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "username" => str_replace(' ', '', $this->get('username', '')),
        ]);
    }
}
