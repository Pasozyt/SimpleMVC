<?php 

use Services\Translation\TranslationService;

if (!function_exists('__')) {
    function __(string $name, array $arguments = null) 
    {
        return TranslationService::getInstance()->translate($name, $arguments);
    }
}