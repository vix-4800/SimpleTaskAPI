<?php

namespace App\Exceptions;

use Exception;

class NotTaskOwnerException extends Exception
{
    public function __construct()
    {
        parent::__construct('You are not allowed to access this task', 403);
    }
}
