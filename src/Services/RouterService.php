<?php

namespace Vitab\TaskManagementSystem\Services;

class RouterService
{
    static private array $routes = [];

    static public function get(
        string $path,
        string $controller,
        string $function,
    ): void {
        self::$routes[] = [
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'method' => 'GET',
        ];
    }

    static public function post(
        string $path,
        string $controller,
        string $function
    ): void {
        self::$routes[] = [
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'method' => 'POST',
        ];
    }

    public function doRouting(?string $path, string $method, array $params): void
    {
        $id = null;
        $firstPart = explode('?', $path);
        $urlData = $firstPart[1] ?? '';
        $pathParts = explode('/', $firstPart[0]);

        if (isset($pathParts[2]) && is_numeric($pathParts[2])) {
            $id = (int) $pathParts[2];
            $pathParts[2] = '{id}';
        }

        $routePath = implode('/', $pathParts);

        [$controller, $function] = $this->getControllerAndFunction(
            strlen($routePath) > 1 ? rtrim($routePath, '/') : $routePath,
            $method
        );

        if ($controller === null && $function === null) {
            require './views/error_page.php';
            die;
        }

        $c = new $controller();

        if (is_numeric($id) && !empty($params)) {
            $c->$function($id, $params);
            return;
        }

        if (!empty($params)) {
            $c->$function($params);
            return;
        }

        if (is_numeric($id)) {
            $c->$function($id);
            return;
        }

        $c->$function($urlData);

    }

    private function getControllerAndFunction(string $path, string $method): array
    {
        foreach (self::$routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                return [$route['controller'], $route['function']];
            }
        }
        return [null, null]; // Throw exception
    }
}
