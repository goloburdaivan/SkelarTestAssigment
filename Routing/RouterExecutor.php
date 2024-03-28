<?php

namespace Routing;

class RouterExecutor
{

    private Router $router;
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function execute(string $method, string $uri): void
    {
        $routes = $this->router->getRoutes();
        if (!array_key_exists($uri, $routes) || !array_key_exists($uri, $routes[$method])) {
            http_response_code(404);
            echo "404! Page not found!";
            return;
        }

        $action = $routes[$uri][$method];
        $controllerClass = $action[0];
        $controllerMethod = $action[1];
        $controller = new $controllerClass();
        $controller->$controllerMethod();
    }
}