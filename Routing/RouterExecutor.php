<?php

namespace Routing;

use HttpStatus;
use Responses\NotFoundResponse;

require_once  './Constants/HttpStatus.php';
require_once './Responses/NotFoundResponse.php';
require_once  './Routing/ParameterizedRoutesHelper.php';

class RouterExecutor
{
    private Router $router;
    private ParameterizedRoutesHelper $routesHelper;
    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->routesHelper = new ParameterizedRoutesHelper();
    }

    private function executeAction(string $uri, string $method, array $params = []) {
        $action = $this->router->getRoutes()[$uri][$method];
        $controllerClass = $action[0];
        $controllerMethod = $action[1];
        $controller = new $controllerClass();
        $controller->$controllerMethod(...$params);
    }
    public function execute(string $method, string $uri): void
    {
        $routes = $this->router->getRoutes();
        $parameters = $this->routesHelper->processParameterizedRoutes($routes, $uri);
        if (!empty($parameters)) {
            $this->executeAction($parameters[0], $method, $parameters[1]);
            return;
        }

        if (!array_key_exists($uri, $routes)) {
            http_response_code(HttpStatus::HTTP_NOT_FOUND);
            echo new NotFoundResponse();
            return;
        }

        $this->executeAction($uri, $method);
    }
}