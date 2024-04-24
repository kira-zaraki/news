<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function shouldReturnJson($request, Throwable $e): bool{
        return true;
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) { 

            return response()->render([
                'status' => 'not_found',
                'message' => 'news not found',
                'errors' => 'The requested news does not exist.',
            ]);
        }

        return parent::render($request, $exception);
    } 

    protected function unauthenticated($request, AuthenticationException $exception): Response{
        return response([
                'status' => 'unauthorized',
                'status_code' => response::HTTP_UNAUTHORIZED,
                'code' => 0,
                'message' => 'unauthorized',
                'errors' => 'you dont have permission to use this endpoint',
            ]);
    } 


}
