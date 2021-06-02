<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthorizationException)
        {
            return response()->json(['result' => false,'message' => 'No esta autorizado.'],403);
        }

        if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return response()
                    ->json(['result' => false, 'message' =>  'El token ha expirado'], 400);
        } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return response()->json(['result' => 'false', 'message' => 'El token no es válido'], 400);
        } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
            return response()->json(['result' => 'false ', 'message' => 'No se esta enviando el token'], 400);
        }
        return parent::render($request, $e);
    }

}
