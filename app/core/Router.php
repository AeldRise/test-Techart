<?php

namespace App\Core;

use ReflectionMethod;

class Router
{
    protected array $routes = [];

    public function add(
        string $method,
        string $path,
        array $controller
    ) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $this->normalizePath($path),
            'controller' => $controller
        ];
    }

    protected function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        return "/{$path}/";
    }

    public function dispatch(string $requestPath, ?string $requestMethod = null)
    {
        $requestPath = $this->normalizePath($requestPath);
        $requestMethod = strtoupper($requestMethod ?? $_SERVER['REQUEST_METHOD'] ?? 'GET');
        foreach ($this->routes as $route) {
            $pattern = preg_replace('/{[^}]+}/', '([^/]+)', $route['path']);
            if (preg_match("#^{$pattern}$#", $requestPath, $matches) && $route['method'] === $requestMethod ) {
                preg_match_all('/{([^}]+)}/', $route['path'], $paramNames);
                $paramValues = array_slice($matches, 1);
                [$className, $action] = $route['controller'];
                $controller = new $className();
                $reflection = new ReflectionMethod($className, $action);
                $reflection->invokeArgs($controller, $paramValues);
                return;
            } else {
                continue;
            }
        }
        http_response_code(404);
        echo 'Not Found';
    }
}