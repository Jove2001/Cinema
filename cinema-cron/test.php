<?php

require_once __DIR__ . '/vendor/autoload.php';

// Set the server timezone
date_default_timezone_set(\CinemaCron\Config\Config::TIME_ZONE);

// Prevent this process from timing out
set_time_limit(300);

try {
    $date = date("Y-m-d");

    $dynamoDb = \CinemaCron\DynamoDbConnection::connect();

    // $partiqlStatement = "SELECT * FROM Sessions WHERE #date >= :today";
    $params = [
        'TableName' => 'Sessions',
        'FilterExpression' => '#date >= :date_value',
        'ExpressionAttributeNames' => ['#date' => 'date'],
        'ExpressionAttributeValues' => [
            ':date_value' => [
                'S' => $date
            ]
        ]
    ];

    $result = $dynamoDb->query($params);

    // $items = $result['Items'];

    var_dump($result);
} catch (\Aws\DynamoDb\Exception\DynamoDbException $e) {
    echo "Error executing PartiQL statement: " . $e->getMessage();
} catch (\Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
