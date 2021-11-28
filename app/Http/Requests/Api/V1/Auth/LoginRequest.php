<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Api\V1\Auth
 * @property string username
 * @property string password
 */
class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username" => "required|string|min:3|max:255",
            "password" => "required|string|min:6|max:255",
        ];
    }
}
