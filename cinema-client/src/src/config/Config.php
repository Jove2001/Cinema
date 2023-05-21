<?php

namespace CinemaClient\Config;

/**
 * Config settings for CinemaClient application
 * 
 * Config.php 13/05/2023
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
     * AWS endpoints
     */
    const CLOUD_FRONT = 'https://drjdjxxugb49g.cloudfront.net';
    const GET_SESSIONS = "https://08wighmdk7.execute-api.us-east-1.amazonaws.com/default/getSessions";
    const MAKE_BOOKING = "https://5dpcqyrfe8.execute-api.us-east-1.amazonaws.com/default/makeBooking";
}
