<?php

namespace App\Http\Resources\V1\Auth;

use App\Interfaces\StatusCodeable;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LoginResource
 * @package App\Http\Resources\V1\Auth
 * @method \Laravel\Passport\PersonalAccessTokenResult createToken($name, array $scopes = [])
 * @property string username
 * @property string role
 */
class LoginResource extends JsonResource implements StatusCodeable
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "username" => $this->username,
            "token"    => $this->createToken('nApp')->accessToken,
            "role"     => $this->role,
        ];
    }

    public function with($request)
    {
        return [
            "description" => "Save this token carefully",
            "code"        => $this->statusCode(),
        ];
    }

    public function statusCode(): int
    {
        return 200;
    }
}
