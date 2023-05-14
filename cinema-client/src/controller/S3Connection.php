<?php

namespace CinemaClient\Controller;

use Aws\S3\S3Client;
use CinemaClient\Config\Config;

/**
 * Connection to AWS S3 Bucket
 * 
 * S3Connection.php 23/04/2023
 *
 * Copyright (c) 2023 Ian McElwaine s3863018@rmit.student.edu.au
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class S3Connection
{
    /**
     * Returns a configured AWS S3 client
     * 
     * @return S3Client the configured client
     */
    static function connect()
    {
        $s3Client = new S3Client(Config::AWS_CONFIG);

        return $s3Client;
    }


}
