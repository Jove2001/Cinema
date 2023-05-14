<?php

namespace CinemaClient\Controller;

use CinemaClient\Config\Config;

/**
 * MySQL db connnection
 */
class MySQLConnection
{
    /**
     * PDO instance
     * @var type 
     */
    private $pdo;

    /**
     * Return an instance of the PDO object that connects to the MySQL database
     * @return \PDO
     */
    public function connect()
    {
        if ($this->pdo == null) {
            $dsn = "mysql:host=".Config::HOST.";dbname=" . Config::DB_NAME . ";charset=utf8mb4;port=" . Config::PORT;
            $this->pdo = new \PDO($dsn, Config::USER_NAME, Config::PASSWORD);
        }
        return $this->pdo;
    }
}
