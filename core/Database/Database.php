<?php namespace Core\Database;

use Exception;
use mysqli;
use mysqli_result;

class Database{
    protected $connection;

    public function __construct()
    {
        $config = require __DIR__ . "./../../config/database.php";
        // Создание подключения к базе данных
        $this->connection = new mysqli($config['host'], $config['username'], $config['password'], $config['database'], $config['port']);

        // Проверка на ошибки подключения
        if ($this->connection->connect_error) {
            throw new Exception("Database connection failed: " . $this->connection->connect_error);
        }
    }

    public function query(string $query){
        return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    public function queryNotExicute(string $query){
        return $this->connection->query($query);
    }
}