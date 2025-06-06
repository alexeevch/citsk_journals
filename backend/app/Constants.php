<?php

namespace App;

class Constants
{
    /*
    |--------------------------------------------------------------------------
    | MESSAGES
    |--------------------------------------------------------------------------
     */

    public const USER_UNAUTHORIZED_MESSAGE = 'Unauthorized';
    public const USER_UNAUTHENTICATED_MESSAGE = "Unauthenticated";
    public const NOT_FOUND_MESSAGE = "Not found";
    public const DUPLICATE_ENTRY_MESSAGE = "Duplicate entry";

    /*
    |--------------------------------------------------------------------------
    | ERROR CODES
    |--------------------------------------------------------------------------
     */

    public const DUPLUCATE_ENTRY_CODE = 1062;

    /*
    |--------------------------------------------------------------------------
    | ROLES
    |--------------------------------------------------------------------------
     */

    public const ROOT_ROLE = "root";
    public const ADMIN_ROLE = "admin";
    public const OBSERVER_ROLE = "observer";

}
