<?php

// MySQL server settings
const USER_NAME = "cinema";
const PASSWORD = "C1i1n1e1m1a1";
const DB_NAME = "cinema";
const PORT = 3306;
const HOST = "cinema.cgpisnjxybda.us-east-1.rds.amazonaws.com";

// Load genre data
$genres = json_decode(file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=aeb1abd20469a56d7b2bf325cc97c92f'), true)['genres'];

// Store in MySQL
$dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4;port=" . PORT;
$pdo = new \PDO($dsn, USER_NAME, PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$SQL = <<<SQL
    INSERT INTO Genres (id, name)
    VALUES (:id, :name)
SQL;
$stmt = $pdo->prepare($SQL);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':name', $name);

for ($i = 0; $i < sizeof($genres); $i++) {
    $id = $genres[$i]['id'];
    $name = $genres[$i]['name'];
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Database connection failed' . "\n";
        echo $e->getMessage();
    }
}
