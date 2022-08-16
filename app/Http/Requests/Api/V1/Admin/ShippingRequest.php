<?php

namespace App\Http\Requests\Api\V1\Admin;

use App\Models\Shipping;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $status
 */
class ShippingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "status" => "required|string|in:" . join(',', [Shipping::STATUS_PENDING, Shipping::STATUS_PROCESS, Shipping::STATUS_SEND, Shipping::STATUS_REJECT])
        ];
    }
}
