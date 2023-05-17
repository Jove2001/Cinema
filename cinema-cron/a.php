<?php

// file_put_contents('config.json', file_get_contents('https://api.themoviedb.org/3/configuration?api_key=aeb1abd20469a56d7b2bf325cc97c92f'));

require_once __DIR__ . '/vendor/autoload.php';

use CinemaCron\Config\Config;
use CinemaCron\MySqlConnection;
use CinemaCron\DynamoDbConnection;
use Aws\DynamoDb\Marshaler;
use CinemaCron\S3Connection;

// Set the server timezone
date_default_timezone_set(Config::TIME_ZONE);

// Prevent this process from timing out
set_time_limit(300);

$dynamoDb = DynamoDbConnection::connect();

$today = date_create('now');
date_sub($today, date_interval_create_from_date_string("1 days"));
$date_to_delete = date_format($today, "Y-m-d");
// echo $date_to_delete;
// var_dump($date_to_delete);
// exit;

$key = [
    'Item' => [
        'date' => [
            'S' => $date_to_delete
        ]
    ]
];

$dynamoDb->deleteItem(
    [
        'Key' => $key['Item'],
        'TableName' => 'Sessions'
    ]
);
