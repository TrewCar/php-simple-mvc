<?php namespace Core\Database;

use PDO;
use PDOException;

class Database
{
    protected $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $config = require __DIR__ . "./../../config/database.php";
        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']};port={$config['port']}";

        try {
            $this->connection = new PDO($dsn, $config['username'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed: " . $e->getMessage());
        }
    }

    public function query(string $query)
    {
        $stmt = $this->connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(string $query)
    {
        return $this->connection->exec($query);
    }
}
