<?php 

namespace Exceptions;

class TemplateNotFoundException extends AppException
{
    public function __construct()
    {
        parent::__construct("Template not found", 500, null);
    }
}