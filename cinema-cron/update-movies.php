<?php

/**
 * Update the movies database with the latest movie information from TheMovieDb.
 */

date_default_timezone_set('Australia/Melbourne');

$results = array();
$movies = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=aeb1abd20469a56d7b2bf325cc97c92f&region=AU&page=1'));
for ($j = 0; $j < sizeof($movies->results); $j++) {
    $results[] = $movies->results[$j];
}
$no_of_pages = $movies->total_pages;

for ($i = 2; $i <= $no_of_pages; $i++) {
    $movies = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=aeb1abd20469a56d7b2bf325cc97c92f&region=AU&page=' . $i));
    for ($j = 0; $j < sizeof($movies->results); $j++) {
        $results[] = $movies->results[$j];
    }
}

// MySQL server settings
const USER_NAME = "cinema";
const PASSWORD = "C1i1n1e1m1a1";
const DB_NAME = "cinema";
const PORT = 3306;
const HOST = "cinema.cgpisnjxybda.us-east-1.rds.amazonaws.com";

$dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4;port=" . PORT;
$pdo = new \PDO($dsn, USER_NAME, PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$SQL = <<<SQL
    INSERT INTO Movies (
        adult, 
        backdrop_path, 
        genre_ids, 
        id, 
        original_language, 
        original_title, 
        overview, 
        popularity, 
        poster_path, 
        release_date, 
        title, 
        video, 
        vote_average, 
        vote_count
        )
    VALUES (
        :adult, 
        :backdrop_path, 
        :genre_ids, 
        :id, 
        :original_language, 
        :original_title, 
        :overview, 
        :popularity, 
        :poster_path, 
        :release_date, 
        :title, 
        :video, 
        :vote_average, 
        :vote_count
        )
SQL;

$stmt = $pdo->prepare($SQL);
$stmt->bindParam(':adult', $adult);
$stmt->bindParam(':backdrop_path', $backdrop_path);
$stmt->bindParam(':genre_ids', $genre_ids);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':original_language', $original_language);
$stmt->bindParam(':original_title', $original_title);
$stmt->bindParam(':overview', $overview);
$stmt->bindParam(':popularity', $popularity);
$stmt->bindParam(':poster_path', $poster_path);
$stmt->bindParam(':release_date', $release_date);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':video', $video);
$stmt->bindParam(':vote_average', $vote_average);
$stmt->bindParam(':vote_count', $vote_count);

$start_time = time();
$msg = "Log for update run on " . date(DATE_COOKIE) . PHP_EOL;
file_put_contents("/home/ubuntu/cinema-cron/logs/update-errors-" . $start_time . ".log", $msg,  FILE_APPEND | LOCK_EX);

for ($i = 0; $i < sizeof($results); $i++) {
    try {
        $adult = $results[$i]->adult;
        $backdrop_path = $results[$i]->backdrop_path;
        $genre_ids = json_encode($results[$i]->genre_ids);
        $id = $results[$i]->id;
        $original_language = $results[$i]->original_language;
        $original_title = $results[$i]->original_title;
        $overview = $results[$i]->overview;
        $popularity = $results[$i]->popularity;
        $poster_path = $results[$i]->poster_path;
        $release_date = $results[$i]->release_date;
        $title = $results[$i]->title;
        $video = $results[$i]->video;
        $vote_average = $results[$i]->vote_average;
        $vote_count = $results[$i]->vote_count;
        $stmt->execute();
    } catch (PDOException $e) {
        $msg = "Unable to insert movie id: " . $id . " " . $original_title . PHP_EOL;
        $msg .= $e->getMessage() . PHP_EOL . PHP_EOL;
        file_put_contents("/home/ubuntu/cinema-cron/logs/update-errors-" . $start_time . ".log", $msg,  FILE_APPEND | LOCK_EX);
    }
}
