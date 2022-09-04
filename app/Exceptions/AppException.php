<?php 

namespace Exceptions;

use Exception;
use Throwable;
use Services\Logger\Log;

class AppException extends Exception
{
    public function __construct(
        string $message,
        int $code = 0,
        Throwable $previous = null
    )
    {
        /*
        parent::__construct($message, $code, $previous);
        Log::error($message);
        if ($previous !== null) {
            Log::error($previous->getMessage());
        }
        */
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }    
}