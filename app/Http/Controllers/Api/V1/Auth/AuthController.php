<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Resources\V1\Auth\LoginResource;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @throws UserNotFoundException
     */
    public function login(LoginRequest $request)
    {
        $user = User::whereUsername($request->username)->first();

        if (!$user) {
            throw new UserNotFoundException("User not found");
        }

        if (!\Hash::check($request->password, $user->password)) {
            throw new UserNotFoundException("Password wrong!");
        }

        return new LoginResource($user);
    }
}
