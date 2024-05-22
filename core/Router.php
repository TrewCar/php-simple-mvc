<?php namespace Core;

use Core\Data\RouterPath;
use Exception;

class Router
{
    protected $routes = [];

    public function add(string $path, string $controller, string $action, $middleware = [])
    {
        // Преобразование пути с параметрами в регулярное выражение
        $path = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_]+)', $path);
        $this->routes["#^$path$#"] = new RouterPath($controller, $action, $middleware);
    }

    public function dispatch(string $uri)
    {
        foreach ($this->routes as $pattern => $route) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Удаляем первый элемент, который содержит полный путь
                $this->handleMiddleware($route->Middleware, $route, $matches);
                return;
            }
        }
    }

    protected function handleMiddleware(array $middleware, RouterPath $route, array $params)
    {
        $request = ['uri' => $_SERVER['REQUEST_URI'], 'params' => $params];

        $next = function ($request) use ($route, $params) {
            $this->callAction($route->Controller, $route->Action, $params);
        };

        foreach (array_reverse($middleware) as $middlewareClass) {
            $next = function ($request) use ($middlewareClass, $next) {
                $middlewareInstance = new $middlewareClass;
                if (method_exists($middlewareInstance, 'handle')) {
                    return $middlewareInstance->handle($request, $next);
                }
            };
        }

        return $next($request);
    }

    protected function callAction(string $controllerName, string $methodName, array $params = [])
    {
        $controllerClass = "App\\Controllers\\{$controllerName}";
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass;
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
            } else {
                echo "Method $methodName not found in controller $controllerClass";
            }
        } else {
            echo "Controller class $controllerClass not found";
        }
    }
}
