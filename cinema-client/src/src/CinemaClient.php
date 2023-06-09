<?php

namespace CinemaClient;

use Exception;
use CinemaClient\Config\Config;
use CinemaClient\View\Router;
use CinemaClient\Controller\PostRouter;
use CinemaClient\Controller\BadRequestException;
use stdClass;

/**
 * CinemaClient front-end controller
 * 
 * CinemaClient.php 13/05/2023
 *
 * Copyright (c) 2023 Ian McElwaine <mailto:s3863018@rmit.student.edu.au>
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class CinemaClient
{
    /**
     * Apply application settings
     */
    function __construct()
    {
        session_start();

        // Set the server timezone
        date_default_timezone_set(Config::TIME_ZONE);
    }

    /**
     * Run the application
     */
    function run()
    {
        // Global view command object [1]
        global $route;

        // Catch show-stopper exceptions at top of stack
        try {
            // If $_POST data received then find a post route
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                $route = PostRouter::route();

            // Otherwise find a view route
            else
                $route = Router::route();
        }

        // Catch bad requests to the controllers
        catch (BadRequestException $e) {
            header("Location: /index.php");
        }

        // Catch unexpected exceptions and notify user
        catch (Exception $e) {
            $route = new stdClass();
            $route->Title = "Something went wrong";
            $route->View = __DIR__ . '/view/views/error.view.php';
            $route->ErrorMessage = $e->getMessage();
        }

        // Load the main view
        require_once __DIR__ . '/view/views/main.view.php';

        // Debug section
        if (!Config::PRODUCTION) require __DIR__ . '/view/views/debug.view.php';
    }
}

/**
 * References
 * 
 * [1] Dockins, Kelt. Design Patterns in PHP and Laravel. 1st ed. 2017., Apress, 2017, https://doi.org/10.1007/978-1-4842-2451-9.
 */
