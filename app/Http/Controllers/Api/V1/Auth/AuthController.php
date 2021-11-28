<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Resources\V1\Auth\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::whereUsername($request->username)->first();

        if (!$user) {
            throw new NotFoundHttpException("User not found");
        }

        if (!\Hash::check($request->password, $user->password)) {
            throw new NotFoundHttpException("Password wrong!");
        }

        return new LoginResource($user);
    }
}
