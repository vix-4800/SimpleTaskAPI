<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $exceptionData = [
            ModelNotFoundException::class => [
                'status' => 404,
                'error' => 'Not Found',
                'message' => 'Task not found',
            ],
            \TypeError::class => [
                'status' => 422,
                'error' => 'Wrong parameters',
                'message' => 'One or more parameters are invalid',
            ],
            MethodNotAllowedHttpException::class => [
                'status' => 405,
                'error' => 'Bad Request',
                'message' => 'This method is not supported for this route',
            ],
            AuthorizationException::class => [
                'status' => 403,
                'error' => 'Forbidden',
                'message' => 'You are not allowed to access this task',
            ],
        ];

        if ($request->wantsJson() && array_key_exists(get_class($exception), $exceptionData)) {
            $data = $exceptionData[get_class($exception)];

            return response()
                ->json($data)
                ->setStatusCode($data['status']);
        }

        return parent::render($request, $exception);
    }
}
