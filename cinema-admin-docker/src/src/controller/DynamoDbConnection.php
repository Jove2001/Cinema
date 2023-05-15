<?php

namespace CinemaAdmin\Controller;

use Aws\DynamoDb\DynamoDbClient;
use Aws\Sdk;
use CinemaAdmin\Config\Config;

/**
 * Connection to AWS DynamoDb
 * 
 * DynamoDbConnection.php 23/04/2023
 *
 * Copyright (c) 2023 Ian McElwaine s3863018@rmit.student.edu.au
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class DynamoDbConnection
{
    /**
     * Returns a configured DynamoDb client
     * 
     * @return DynamoDbClient the configured client
     */
    static function connect()
    {
        $sdk = new Sdk(Config::AWS_CONFIG);

        $dynamoDb = $sdk->createDynamoDb();

        return $dynamoDb;
    }
}

// https://docs.aws.amazon.com/sdk-for-php/
// https://github.com/awsdocs/aws-doc-sdk-examples/tree/main/php/example_code/dynamodb