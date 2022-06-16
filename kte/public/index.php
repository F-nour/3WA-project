<?php

/**
 * @file index.php
 * @brief index.php file.
 * @var string $root : root directory.
 * @var string $autoload : autoload path.
 * @var string $helpers : helpers path.
 * @require $autoload
 * @require $helpers
 */

/**
 * @brief start session.
 * @function session_start()
 */
session_start();

$root = dirname(__DIR__);
$autoload = $root . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; // autoload composer
$helpers = $root . '/config/helpers.php';
$debug = $root . '/config/debug.php';

require $autoload;
require $helpers;
require $debug;

/**
 * @brief Use the Router class and the NotFoundException class.
 * @uses \Library\Router\Router : Router class.
 * @uses \Library\Http\NotFoundException : NotFoundException class.
 */

use App\Controller\ErrorController;
use Library\Http\NotFoundException;
use Library\Router\Router;

try {
    /**
     * @brief instentiate the Router class.
     * @function Router->goToRoute() : go to the route.
     */
    $router = new Router();
    $router->goToRoute();
} catch (NotFoundException $nfe) {
    /**
     * @brief if the route is not found, display the 404 page.
     * @class NotFoundException($nfe) Affiche la page d'erreur 404
     */
    logAction('http', 'badRequest', $nfe->getMessage());
    http_response_code(404);
    header("HTTP/1.0 404 Not Found");
    $controller = new ErrorController();
    $controller->notFound();
} catch (PDOException $pdoe) {
    /**
     * @brief if the database is not found, display the 500 page.
     * @class \PDOException($pdoe) Affiche la page d'erreur 500
     */
    logAction('pdo', 'applicationError', $pdoe->getMessage());
    http_response_code(500);
    $controller = new ErrorController();
    $controller->forbidden();
    exit();
}
