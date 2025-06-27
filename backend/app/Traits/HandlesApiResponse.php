<?php

namespace App\Traits;

use App\Constants\ErrorMessages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Throwable;

trait HandlesApiResponse
{
    protected function respondSuccess(
        JsonResource|ResourceCollection|array $data = [],
        string $message = 'Success',
        int $code = HttpResponse::HTTP_OK
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function respondCreated(
        JsonResource $resource,
        string $message = 'Resource created successfully'
    ): JsonResponse {
        return $this->respondSuccess($resource, $message, HttpResponse::HTTP_CREATED);
    }

    protected function respondNotFound(
        string $message = ErrorMessages::NOT_FOUND
    ): JsonResponse {
        return $this->respondError($message, HttpResponse::HTTP_NOT_FOUND);
    }

    protected function respondUnauthorized(
        string $message = ErrorMessages::UNAUTHORIZED
    ): JsonResponse {
        return $this->respondError($message, HttpResponse::HTTP_UNAUTHORIZED);
    }

    protected function respondForbidden(
        string $message = ErrorMessages::FORBIDDEN
    ): JsonResponse {
        return $this->respondError($message, HttpResponse::HTTP_FORBIDDEN);
    }

    protected function respondValidationError(
        ValidationException|string|array $errors,
        string $message = ErrorMessages::VALIDATION_FAILED
    ): JsonResponse {
        $errorData = $errors instanceof ValidationException
            ? $errors->errors()
            : (is_array($errors) ? $errors : ['general' => [$errors]]);

        return response()->json([
            'success' => false,
            'message' => $message,
            'errors'  => $errorData,
        ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function respondError(
        string $message,
        int $code = HttpResponse::HTTP_BAD_REQUEST,
        ?array $errors = null
    ): JsonResponse {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    protected function respondInternalError(
        Throwable $e,
        string $message = ErrorMessages::INTERNAL_SERVER_ERROR
    ): JsonResponse {
        return $this->respondError(
            $this->shouldDisplayDetailedErrors() ? $e->getMessage() : $message,
            HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
            $this->shouldDisplayDetailedErrors() ? ['trace' => $e->getTraceAsString()] : null
        );
    }

    protected function respondNoContent(): JsonResponse
    {
        return response()->json(null, HttpResponse::HTTP_NO_CONTENT);
    }

    protected function shouldDisplayDetailedErrors(): bool
    {
        return config('app.debug');
    }
}
