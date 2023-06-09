<?php

namespace CinemaCron\Config;

/**
 * Config settings for CinemaCron application
 * 
 * Config.php 17/05/2023
 *
 * Copyright (c) 2023 Ian McElwaine s3863018@rmit.student.edu.au
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class Config
{
    /**
     * Set to true before deploying this app
     */
    const PRODUCTION = true;

    /**
     * Server timezone
     */
    const TIME_ZONE = 'Australia/Melbourne';

    // MySQL server settings
    const USER_NAME = "cinema";
    const PASSWORD = "C1i1n1e1m1a1";
    const DB_NAME = "cinema";
    const PORT = 3306;
    const HOST = "cinema.cgpisnjxybda.us-east-1.rds.amazonaws.com";

    /**
     * Settings for AWS clients
     */
    const AWS_CONFIG = [
        'region' => 'us-east-1',
        'version' => 'latest'
    ];

    /**
     * AWS S3 bucket for CinemaCron application
     */
    const AWS_BUCKET = 's3863018-movie-posters';

    const DELETE_SESSION = 'https://fi84g54odk.execute-api.us-east-1.amazonaws.com/default/deleteSession';

    const UPDATE_SESSION = 'https://369yy2lg2j.execute-api.us-east-1.amazonaws.com/default/updateSessions';
}
