<?php

namespace Routing;

use HttpMethods;
use Validators\RequestValidator;
require_once './Validators/RequestValidator.php';
require_once './Constants/HttpMethods.php';

class Router
{
    private array $routes = [];
    private RequestValidator $requestValidator;

    public function __construct()
    {
        $this->requestValidator = new RequestValidator();
    }

    private function registerRoute(string $route, string $method, array $action): void
    {
        $route = rtrim($route, '/');
        if (!array_key_exists($route, $this->routes)) {
            $this->routes[$route] = [];
        }

        $this->routes[$route][$method] = $action;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function get(string $route, array $action): void
    {
        $this->requestValidator->validateRequestMethod(HttpMethods::HTTP_GET);
        $this->registerRoute($route, HttpMethods::HTTP_GET, $action);
    }

    public function post(string $route, array $action): void
    {
        $this->requestValidator->validateRequestMethod(HttpMethods::HTTP_POST);
        $this->registerRoute($route, HttpMethods::HTTP_POST, $action);
    }
}