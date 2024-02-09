<?php

namespace App\classes;

class Database
{
    const CONFIG = [
        "host" => "localhost",
        "port" => 3306,
        "dbname" => "shortly",
        "user" => "root",
        "password" => ""
    ];
    public $connection;

    private function getConfig() {
        return require_once __DIR__ . '/../configs/db.php';
    }

    public function __construct()
    {
        $host = self::CONFIG['host'];
        $port = self::CONFIG['port'];
        $dbname = self::CONFIG['dbname'];

        $this -> connection = new \PDO(
            "mysql:host={$host};port={$port};dbname={$dbname}",
            self::CONFIG['user'],
            self::CONFIG['password'],
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