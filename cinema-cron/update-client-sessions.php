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
    SELECT Sessions.date, Movies.*
    FROM Sessions
    JOIN Movies
    ON Sessions.id = Movies.id
    WHERE Sessions.date >= CURDATE()
SQL;

$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$sessions = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM Genres");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$genre_data = $stmt->fetchAll();

$dynamoDb = \CinemaCron\DynamoDbConnection::connect();
$marshaler = new \Aws\DynamoDb\Marshaler();

for ($i = 0; $i < sizeof($sessions); $i++) {
    $genres = [];
    if (isset($sessions[$i]['genre_ids'])) {
        $genre_ids = json_decode($sessions[$i]['genre_ids']);
        for ($j = 0; $j < sizeof($genre_ids); $j++) {
            for ($k = 0; $k < sizeof($genre_data); $k++) {
                if ($genre_data[$k]['id'] == $genre_ids[$j]) {
                    $genres[] = $genre_data[$k]['name'];
                    break;
                }
            }
        }
        $session = $marshaler->marshalItem(
            [
                'date' => $sessions[$i]['date'],
                'id' => $sessions[$i]['id'],
                'backdrop_path' => $sessions[$i]['backdrop_path'],
                'genres' => $genres,
                'original_language' => $sessions[$i]['original_language'],
                'original_title' => $sessions[$i]['original_title'],
                'overview' => $sessions[$i]['overview'],
                'popularity' => $sessions[$i]['popularity'],
                'poster_path' => $sessions[$i]['poster_path'],
                'release_date' => $sessions[$i]['release_date'],
                'title' => $sessions[$i]['title'],
                'vote_average' => $sessions[$i]['vote_average'],
                'vote_count' => $sessions[$i]['vote_count']
            ]
        );
    } else
        $session = $marshaler->marshalItem(
            [
                'date' => $sessions[$i]['date'],
                'id' => $sessions[$i]['id'],
                'backdrop_path' => $sessions[$i]['backdrop_path'],
                'original_language' => $sessions[$i]['original_language'],
                'original_title' => $sessions[$i]['original_title'],
                'overview' => $sessions[$i]['overview'],
                'popularity' => $sessions[$i]['popularity'],
                'poster_path' => $sessions[$i]['poster_path'],
                'release_date' => $sessions[$i]['release_date'],
                'title' => $sessions[$i]['title'],
                'vote_average' => $sessions[$i]['vote_average'],
                'vote_count' => $sessions[$i]['vote_count']
            ]
        );

    $params = [
        'TableName' => 'Sessions',
        'Item' => $session
    ];

    try {
        $dynamoDb->putItem($params);
        echo $sessions[$i]['title'] . " - Ok\n";
    } catch (Exception $e) {
        echo 'caught exception: ',  $e->getMessage(), "\n";
    }
}

// Get S3 client and upload movies posters
// $s3Client = \CinemaCron\S3Connection::connect();

// // Register the stream wrapper
// $s3Client->registerStreamWrapper();

// Add images
