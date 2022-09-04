<?php 

namespace Exceptions;

use Exception;

class TranslationException extends AppException
{
    public function __construct()
    {
        parent::__construct("Translations not found", 500, null);
    }
}