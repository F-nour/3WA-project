<?php

/**
 * @file index.php
 * @brief index.php file.
 * @uses \Library\Router\Router : Router class.
 * @uses \Library\Http\NotFoundException : NotFoundException class.
 * @uses \App\Controller\ErrorController : ErrorController class.
 * @require $autoload
 * @require $helpers
 */

$root = dirname(__DIR__);
$autoload = $root . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; // autoload composer
$helpers = $root . '/config/helpers.php';
$debug = $root . '/config/debug.php';

require $autoload;
require $helpers;
require $debug;

use App\Controller\ErrorController;
use Library\Http\NotFoundException;
use Library\Router\Router;

session_start();
/**
 * @brief Create a new Router instance.
 * @var $root: root directory.
 * @var $autoload: autoload file
 * @var $helpers: helpers file
 * @var $debug: debug file
 * @var $router Router : Router instance.
 * @var $nfe NotFoundException : NotFoundException instance.
 * @var pdoe PDOEException : PDOEException instance.
 * */
try {
    $router = new Router();
    $router->goToRoute();
} catch (NotFoundException $nfe) {
//    logAction('http', 'badRequest', $nfe->getMessage());
    http_response_code(404);
    header("HTTP/1.0 404 Not Found");
    $controller = new ErrorController();
    $controller->notFound();
} catch (PDOException $pdoe) {
//    logAction('pdo', 'applicationError', $pdoe->getMessage());
    http_response_code(500);
    $controller = new ErrorController();
    $controller->forbidden();
    exit();
}
