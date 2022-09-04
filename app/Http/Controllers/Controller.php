<?php

namespace Http\Controllers;

abstract class Controller 
{
    public function redirect(string $url) 
    {
        if (strpos($url, 'http') === false) {
            $url = route($url);
        } 
        header('Location: ' . $url);
    }
}