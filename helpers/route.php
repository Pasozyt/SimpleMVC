<?php

if(!function_exists('route')){
    function route(string $path=null)
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $hostWithPort = $_SERVER['HTTP_HOST'];
        return $protocol . $hostWithPort . '/' . $path;
    }
}