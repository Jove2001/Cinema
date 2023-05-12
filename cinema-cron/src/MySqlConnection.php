<?php

namespace CinemaCron;

use CinemaCron\Config\Config;

/**
 * Connection to MySqlConnection
 * 
 * MySqlConnection.php 11/05/2023
 *
 * Copyright (c) 2023 Ian McElwaine s3863018@rmit.student.edu.au
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class MySqlConnection
{
    /**
     * Returns a configured MySQL PDO client
     * 
     * @return PDO the configured client
     */
    static function connect()
    {
        $dsn = "mysql:host=" . Config::HOST . ";dbname=" . Config::DB_NAME . ";charset=utf8mb4;port=" . Config::PORT;
        $pdo = new \PDO($dsn, Config::USER_NAME, Config::PASSWORD);
        return $pdo;
    }
}
