<?php 

namespace Exceptions;

class LogException extends AppException
{
    public function __construct()
    {
        parent::__construct("Log error", 500, null);
    }
}