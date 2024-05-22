<?php namespace Core\Data;

/**
 * [Description RoutePath]
 */
class RouterPath{
    public function __construct(string $controller, string $action)
    {
        $this->Controller = $controller;
        $this->Action = $action;
    }
    public string $Controller;
    public string $Action;
}