<?php namespace Core\Middleware;

interface IMiddleware
{
    public function handle($request, $next);
}