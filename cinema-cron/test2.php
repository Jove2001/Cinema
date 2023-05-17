<?php

require_once __DIR__ . '/vendor/autoload.php';

// Set the server timezone
date_default_timezone_set(\CinemaCron\Config\Config::TIME_ZONE);

// Prevent this process from timing out
set_time_limit(300);

// Get the connection
$pdo = (new \CinemaCron\MySQLConnection())->connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = <<<SQL
    SELECT Movies.poster_path, Movies.backdrop_path
    FROM Sessions
    JOIN Movies
    ON Sessions.id = Movies.id
    WHERE Sessions.date >= CURDATE()
SQL;

$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$poster_paths = $stmt->fetchAll();

// Get S3 client and upload movies posters
$s3Client = \CinemaCron\S3Connection::connect();

// Register the stream wrapper
$s3Client->registerStreamWrapper();

// Add posters
for ($i = 0; $i < count($poster_paths); $i++) {
    $stream = fopen('s3://' . \CinemaCron\Config\Config::AWS_BUCKET . $poster_paths[$i]['poster_path'], 'w');
    $img = file_get_contents('https://image.tmdb.org/t/p/w154/'.$poster_paths[$i]['poster_path']);
    fwrite($stream, $img);
    fclose($stream);
}

// Add backdrops
for ($i = 0; $i < count($poster_paths); $i++) {
    $stream = fopen('s3://' . \CinemaCron\Config\Config::AWS_BUCKET . $poster_paths[$i]['backdrop_path'], 'w');
    $img = file_get_contents('https://image.tmdb.org/t/p/w780/'.$poster_paths[$i]['backdrop_path']);
    fwrite($stream, $img);
    fclose($stream);
}
