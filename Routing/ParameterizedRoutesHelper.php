<?php

namespace Routing;

class ParameterizedRoutesHelper
{
    private function parseParameters(string $route, string $path): array {
        $routeParts = explode('/', $route);
        $pathParts = explode('/', $path);

        if (count($routeParts) !== count($pathParts)) {
            return [];
        }

        $params = [];
        foreach ($routeParts as $key => $routePart) {
            if (preg_match('/^{(\w+)}$/', $routePart, $matches)) {
                $params[$matches[1]] = $pathParts[$key];
            } else {
                if ($routePart !== $pathParts[$key]) {
                    return [];
                }
            }
        }

        return [$route, $params];
    }

    private function hasParameters(string $route): bool {
        $routeParts = explode('/', $route);
        foreach ($routeParts as $routePart) {
            if (preg_match('/^{(\w+)}$/', $routePart)) {
                return true;
            }
        }
        return false;
    }

    public function processParameterizedRoutes(array $routes, string $uri): array {
        $parameterized = array_filter(array_keys($routes), [self::class, 'hasParameters']);
        foreach ($parameterized as $route) {
            $params = $this->parseParameters($route, $uri);
            if (!empty($params)) {
                return $params;
            }
        }

        return [];
    }
}