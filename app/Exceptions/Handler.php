<?php

namespace App\Exceptions;

use App\Http\Resources\V1\Errors\AuthenticationErrorResource;
use App\Http\Resources\V1\Errors\NotFoundErrorsCollection;
use App\Http\Resources\V1\Errors\ValidationErrorsCollection;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ValidationException $exception, Request $request) {

            if ($request->wantsJson() || $request->ajax()) {
                return new ValidationErrorsCollection($exception->errors());
            }
        });

        $this->renderable(function (AuthenticationException $exception, Request $request) {

            if ($request->wantsJson() || $request->ajax()) {
                return new AuthenticationErrorResource([]);
            }
        });

        $this->renderable(function (UserNotFoundException $exception, Request $request) {

            if ($request->wantsJson() || $request->ajax()) {
                return new NotFoundErrorsCollection(["user" => $exception->getMessage()]);
            }
        });

        $this->renderable(function (ProductNotFoundException $exception, Request $request) {

            if ($request->wantsJson() || $request->ajax()) {
                return new NotFoundErrorsCollection(["product" => "Product not found."]);
            }
        });
    }
}
