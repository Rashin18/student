<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\Access\AuthorizationException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Handle 403 errors
        if ($exception instanceof AuthorizationException) {
            return response()->view('errors.403', [
                'message' => $exception->getMessage()
            ], 403);
        }

        return parent::render($request, $exception);
    }

    // ... rest of your handler class
}