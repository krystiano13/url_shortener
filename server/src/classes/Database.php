<?php

namespace App\classes;

class Database
{
    private array $config = [];
    public $connection;

    private function getConfig() {
        return require_once __DIR__ . '/../configs/db.php';
    }

    public function __construct()
    {
        $this -> config = $this -> getConfig();

        $host = $this -> config['host'];
        $port = $this -> config['port'];
        $dbname = $this -> config['dbname'];

        $this -> connection = new \PDO(
            "mysql:host={$host};port={$port};dbname={$dbname}",
            $this -> config['user'],
            $this -> config['password'],
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }

    public function query(string $sql, array $params = [])
    {
        $query = $this -> connection -> prepare($sql);
        $query -> execute($params);
        return $query -> fetchAll();
    }
}