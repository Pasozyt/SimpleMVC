<?php 

use Services\Config\ConfigService;

if (!function_exists('config')) {
    function config(string $name = null) 
    {
        return ConfigService::getInstance()->config($name);
    }
}