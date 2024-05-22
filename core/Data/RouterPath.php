<?php namespace Core\Data;

/**
 * [Description RoutePath]
 */
class RouterPath{
    public function __construct(string $controller, string $action, array $middleware = [])
    {
        $this->Controller = $controller;
        $this->Action = $action;
        $this->Middleware = $middleware;
    }
    public string $Controller;
    public string $Action;
    public array $Middleware = [];
}