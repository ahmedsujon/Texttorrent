<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Handle ValidationException (e.g., form validation errors)
        if ($exception instanceof ValidationException) {
            return response()->view('errors.400', [
                'message' => 'Validation failed. Please check your input.',
                'status' => 400
            ], 400);
        }

        // Handle 404 - Not Found (Route or resource not found)
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->view('errors.404', [
                'message' => 'Page not found. The route you requested does not exist.',
                'status' => 404
            ], 404);
        }

        // Handle 403 - Forbidden (Access denied)
        if ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
            return response()->view('errors.403', [
                'message' => 'You do not have permission to access this page.',
                'status' => 403
            ], 403);
        }

        // Handle 500 - Internal Server Error (General errors)
        if ($exception instanceof HttpException && $exception->getStatusCode() == 500) {
            return response()->view('errors.500', [
                'message' => 'Something went wrong. Please try again later.',
                'status' => 500
            ], 500);
        }

        // Handle other HTTP exceptions (like 401, 429, etc.)
        if ($exception instanceof HttpException) {
            return response()->view('errors.401', [
                'message' => $exception->getMessage(),
                'status' => $exception->getStatusCode()
            ], $exception->getStatusCode());
        }

        // Catch all other exceptions (e.g., unexpected errors)
        return response()->view('errors.500', [
            'message' => 'An unexpected error occurred. Please try again later.',
            'status' => 500
        ], 500);
    }
}
