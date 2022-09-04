<?php

use Http\Kernel;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config/di.php');
$container = $containerBuilder->build();
$app = $container->get(Kernel::class);
$app->run($container);