<?php namespace App\Middleware;

use Core\Middleware\IMiddleware;

class HardIpLockMiddleware implements IMiddleware
{
    // Список разрешенных IP-адресов
    protected $allowedIps = ['192.168.0.1']; // Замените на ваши разрешенные IP

    public function handle($request, $next)
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        if (!in_array($ip, $this->allowedIps)) {
            // Если IP не в списке разрешенных, запретить доступ
            http_response_code(403);
            echo "Access Denied";
            return;
        }

        return $next($request);
    }
}
