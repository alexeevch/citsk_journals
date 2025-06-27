<?php

namespace App\Exceptions;

use App\Constants\ErrorMessages;
use App\Traits\HandlesApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Log;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class ApiExceptionHandler extends ExceptionHandler
{
    use HandlesApiResponse;

    protected $levels = [];

    protected $dontReport = [
        AuthorizationException::class,
        AuthenticationException::class,
        ValidationException::class,
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            return $this->handleApiException($e);
        }

        return parent::render($request, $e);
    }

    protected function handleApiException(Throwable $e): JsonResponse
    {
        Log::error('API Exception', [
            'exception' => $e->getMessage(),
            'trace'     => $e->getTraceAsString()
        ]);

        return match (true) {
            $e instanceof NotFoundHttpException,
                $e instanceof ModelNotFoundException => $this->respondNotFound(),

            $e instanceof AuthenticationException => $this->respondUnauthorized(),

            $e instanceof AuthorizationException => $this->respondForbidden($e->getMessage()),

            $e instanceof ValidationException => $this->respondValidationError($e),

            $e instanceof MissingCastTypeException => $this->respondValidationError($e->getMessage()),

            $e instanceof QueryException => $this->handleDatabaseException($e),

            default => $this->handleUnexpectedException($e),
        };
    }

    protected function handleDatabaseException(QueryException $e): JsonResponse
    {
        $message = $this->shouldDisplayDetailedErrors()
            ? $e->getMessage()
            : ErrorMessages::DATABASE_ERROR;

        return match (true) {
            str_contains($e->getMessage(), 'Duplicate') => $this->respondError(
                message: $message,
                code: HttpResponse::HTTP_CONFLICT
            ),

            str_contains($e->getMessage(), 'Integrity constraint violation') => $this->respondError(
                message: $message,
                code: HttpResponse::HTTP_BAD_REQUEST
            ),

            default => $this->respondError(
                message: $message,
                code: HttpResponse::HTTP_INTERNAL_SERVER_ERROR
            ),
        };
    }

    protected function handleUnexpectedException(Throwable $e): JsonResponse
    {
        Log::critical('Unexpected Exception', [
            'exception' => $e->getMessage(),
            'trace'     => $e->getTraceAsString()
        ]);

        return $this->respondError(
            message: $this->shouldDisplayDetailedErrors()
                ? $e->getMessage()
                : ErrorMessages::INTERNAL_SERVER_ERROR,
            code: HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
            errors: $this->shouldDisplayDetailedErrors()
                ? ['trace' => $e->getTrace()]
                : null
        );
    }

    protected function shouldDisplayDetailedErrors(): bool
    {
        return config('app.debug');
    }
}
