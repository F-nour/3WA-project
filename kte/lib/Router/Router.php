<?php

/**
 * @file Router.php
 * @brief Router class file.
 */

/**
 * @namespace Library\Router
 * @brief Library\Router namespace.
 */
namespace Library\Router;

/**
 * @class Router
 * @brief Router class.
 */
class Router
{

    /**
     * @brief Method used to match a route.
     * @variable $routes Array of routes.
     * @variable $route String route to match.
     * @variable $controllerName String name of the controller.
     * @variable $method String name of the method.
     * @throws \Library\Http\NotFoundException If the route is not found.
     */
    public function goToRoute()
    {
        $routes = require '../config/routes.php';
        $route = $_SERVER['REQUEST_URI'] ?? '/';
        if (isset($routes[$route])) {
            $action = $routes[$route];
            $controllerName = $action[0];
            $method = $action[1];

            // Instanciation magique du contrôleur
            $controller = new $controllerName();
            $controller->$method();
        } else {
            throw new \Library\Http\NotFoundException('404 Not Found');
        }
    }
}
