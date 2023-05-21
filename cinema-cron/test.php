<?php

require __DIR__ . "/vendor/autoload.php";

use CinemaCron\Config\Config;

$params = http_build_query(
    [
        'date' => '2023-05-19'
    ]
);

// var_dump($params);
// exit;
$result = file_get_contents(Config::DELETE_SESSION . "?date=2023-05-19");