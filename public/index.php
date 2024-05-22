<?php
require_once __DIR__ . "./../vendor/autoload.php";

// Загрузка кастомных методов
require_once __DIR__ . "./../src/single_method/loader.php";

use Dotenv\Dotenv;

// Load environment variables from .env file
(Dotenv::createImmutable(__DIR__."./../"))->load();



$router = new Core\Router();

// Определение маршрутов
$router->add('', 'HomeController', 'index');
$router->add('about', 'HomeController', 'about');
$router->add('api/user/{id}', 'UserController', 'getData');


// Получение URI
$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Выполнение маршрута
$router->dispatch($request);