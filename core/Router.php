<?php namespace Core;

use Core\Controller\IErrorController;
use Core\Data\Constant;
use Core\Data\RouterPath;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    /** @var RouterPath[] $routes */
    protected array $routes  = [];

    /** @var ?IErrorController $errorController - Error handling controller */
    protected ?IErrorController $errorController = null;
    protected bool $isApi = false;
    public function setErrorController(IErrorController $errorController) : void {
        $this->errorController = $errorController;
    }
    public function add(string $path, string $controller, string $action, $middleware = []) : void
    {
        // Преобразование пути с параметрами в регулярное выражение
        $path = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9_]+)', $path);
        $this->routes["#^$path$#"] = new RouterPath($controller, $action, $middleware);
    }

    public function dispatch(string $uri) : void
    {
        if(str_contains($uri, "api/"))
            $isApi = true;
        foreach ($this->routes as $pattern => $route) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Удаляем первый элемент, который содержит полный путь
                $this->handleMiddleware($route->Middleware, $route, $matches);
                return;
            }
        }
        $this->err404("This path '". parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . "' was not found");
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

    protected function callAction(string $controllerName, string $methodName, array $params = []) : void
    {
        $controllerClass = "App\\Controllers\\{$controllerName}";
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass;
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
            } else {
                $this->err404("The '$methodName' method was not found in the $controllerClass, following the path of the '". parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . "'");
            }
        } else {
            $this->err404("Controller class $controllerClass not found, following the path of the ". parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        }
    }

    #[NoReturn] protected function err404(string $msg) : void {
        Constant::SetError($msg);
        $this?->errorController?->err404();
        exit();
    }
}
