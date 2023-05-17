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
$marshaler = new Marshaler();

$a = $dynamoDb->scan(
    [
        'TableName' => 'Sessions'
    ]
);
var_dump($a['Items'][0]);
