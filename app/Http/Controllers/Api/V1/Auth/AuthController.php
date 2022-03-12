<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\Auth\LoginResource;
use App\Http\Resources\V1\Auth\RegisterResource;
use App\Models\Biodata;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class AuthController extends Controller
{
    /**
     * @throws UserNotFoundException
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            throw new UserNotFoundException("User not found", 404);
        }

        if ($request->password !== $user->password) {
            throw new UserNotFoundException("Password wrong!", 422);
        }

        return new LoginResource($user);
    }

    /**
     * @throws ValidationException
     * @throws InternalErrorException
     */
    public function register(RegisterRequest $request)
    {
        $user    = User::where('username', $request->username)->first();
        $biodata = Biodata::where('phone', $request->phone)->first();

        if ($user || $biodata) {
            throw ValidationException::withMessages([
                "user" => ["Username or phone already used"],
            ]);
        }

        \DB::beginTransaction();
        try {
            $user    = new User($request->validated());
            $user->save();

            $biodata = new Biodata($request->validated());
            $biodata->user_id = $user->id;
            $biodata->save();

            \DB::commit();

            return new RegisterResource($user);
        } catch (\Exception $e) {
            \DB::rollBack();

            throw new InternalErrorException('Something wrong in our server');
        }
    }
}
