<?php

namespace CinemaAdmin\Config;

/**
 * Config settings for MusicStream application
 * 
 * Config.php 04/04/2023
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
    const PRODUCTION = false;

    /**
     * Server timezone
     */
    const TIME_ZONE = 'Australia/Melbourne';

    /**
     * Settings for AWS clients
     */
    const AWS_CONFIG = [
        'region' => 'us-east-1',
        'version' => 'latest'
    ];

    /**
     * AWS S3 bucket for MusicStream application
     */
    const AWS_BUCKET = 's3863018-cinema';

    /**
     *  MySQL server settings
     */
    const USER_NAME = "cinema";
    const PASSWORD = "C1i1n1e1m1a1";
    const DB_NAME = "cinema";
    const PORT = 3306;
    const HOST = "cinema.cgpisnjxybda.us-east-1.rds.amazonaws.com";
}
