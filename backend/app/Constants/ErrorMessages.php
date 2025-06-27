<?php

namespace App\Constants;

final class ErrorMessages
{
    public const NOT_FOUND = 'Resource not found';
    public const UNAUTHORIZED = 'Unauthenticated';
    public const FORBIDDEN = 'Forbidden';
    public const VALIDATION_FAILED = 'Validation failed';
    public const DATABASE_ERROR = 'Database operation failed';
    public const DUPLICATE_ENTRY = 'Duplicate entry detected';
    public const INTEGRITY_CONSTRAINT_VIOLATION = 'Data integrity violation';
    public const INTERNAL_SERVER_ERROR = 'Internal server error';
    public const METHOD_NOT_ALLOWED = 'Method not allowed';
    public const BAD_REQUEST = 'Invalid request';
    public const SERVICE_UNAVAILABLE = 'Service temporarily unavailable';
}
