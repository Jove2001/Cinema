<?php

require_once __DIR__ . '/vendor/autoload.php';

// Set the server timezone
date_default_timezone_set('Australia/Melbourne');

// Prevent this process from timing out
set_time_limit(300);

// Get movie data
// Get the connection
$pdo = (new \CinemaCron\MySQLConnection())->connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = <<<SQL
    SELECT Sessions.date, Sessions.id, Movies.title, Movies.poster_path
    FROM Sessions
    JOIN Movies
    ON Sessions.id = Movies.id
SQL;

$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$sessions = $stmt->fetchAll();

var_dump($sessions);
exit;

// Get S3 client and upload movies posters
$s3Client = \CinemaCron\S3Connection::connect();

// Register the stream wrapper
$s3Client->registerStreamWrapper();

// Add images
