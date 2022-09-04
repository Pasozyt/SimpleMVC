<?php

namespace Http;

use Exception;
use DI\Container;
use Http\Requests\Request;
use Http\Controllers\CityController;
use Http\Controllers\CombinedController;
use Http\Controllers\PostcodeController;

class Kernel 
{
    public function run(Container $container) 
    {
        try {
            // simple routing
            $request = $container->get(Request::class);
            switch ($request->path()) {
                case '/addcity':
                    $container->call(
                        [CityController::class, 'add']
                    );
                    break;
                case '/addcode':
                    $container->call(
                        [PostcodeController::class, 'add']
                    );
                    break;
                case '/addcombined':
                    $container->call(
                        [CombinedController::class, 'add']
                    );
                    break;      
                case '/delcombined':
                    $container->call(
                        [CombinedController::class, 'del']
                    );
                    break;
                case '/delcity':
                    $container->call(
                        [CityController::class, 'del']
                    );
                    break; 
                case '/delpostcode':
                    $container->call(
                        [PostcodeController::class, 'del']
                    );
                    break; 
                case '/postcode':
                    $container->call(
                        [PostcodeController::class, 'index']
                    );
                    break;  
                case '/city':
                    $container->call(
                        [CityController::class, 'index']
                    );
                    break;
                case '/combined':
                    $container->call(
                        [CombinedController::class, 'index']
                    );
                    break;        
                default:
                    $container->call(
                        [CombinedController::class, 'index']
                    );
            }
        } catch (Exception $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }
}