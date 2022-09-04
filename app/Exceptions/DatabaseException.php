<?php 

namespace Exceptions;

use Exception;

class DatabaseException extends AppException
{
    public function __construct(Exception $e = null)
    {
        parent::__construct("Database error", 500, $e);
    }
}