<?php

namespace Routing;

use HttpStatus;
use Responses\NotFoundResponse;

require_once  './Constants/HttpStatus.php';
require_once './Responses/NotFoundResponse.php';

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
        if (!array_key_exists($uri, $routes)) {
            http_response_code(HttpStatus::HTTP_NOT_FOUND);
            echo new NotFoundResponse();
            return;
        }

        $action = $routes[$uri][$method];
        $controllerClass = $action[0];
        $controllerMethod = $action[1];
        $controller = new $controllerClass();
        $controller->$controllerMethod();
    }
}