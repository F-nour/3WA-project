<?php

namespace Library\Router;

use AltoRouter;

class Router
{

    public function goToRoute()
    {
        $routes = require '../lib/Router/routes.php';
        $route = $_SERVER['REQUEST_URI'] ?? '/';
        if (isset($routes[$route])) {
            $action = $routes[$route];
            $controllerName = $action[0];
            $method = $action[1];

            // Instanciation magique du contrôleur
            $controller = new $controllerName();
            $controller->$method();
        } else {
            header("HTTP/1.1 404 Not Found");
            $controller = new \App\Controller\ErrorController();
            $controller->display();
        }
    }
}
