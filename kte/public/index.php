<?php
// Autoloader
$autoload = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; // autoload composer
require $autoload;

// development mode
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


// create and run application
use Library\Router\Router;

$router = new Router();
$router->goToRoute();
