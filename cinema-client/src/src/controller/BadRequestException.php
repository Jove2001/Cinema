<?php

namespace CinemaClient\Controller;

use Exception;

/**
 * Thrown to indicate that the request does not have a matching controller.
 * This should NOT be thrown during normal operation. Log the incidents.  
 * 
 * BadRequestException.php 04/04/2023
 *
 * Copyright (c) 2023 Ian McElwaine s3863018@rmit.student.edu.au
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class BadRequestException extends Exception
{
    /**
     * Creates an incident log
     */
    function __construct($e)
    {
        // LOG THIS
    }
}


