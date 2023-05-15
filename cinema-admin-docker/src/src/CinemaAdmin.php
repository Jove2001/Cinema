<?php

namespace CinemaAdmin;

use Exception;
use CinemaAdmin\Config\Config;
use CinemaAdmin\Controller\PostRouter;
use CinemaAdmin\Controller\BadRequestException;
use stdClass;

/**
 * CinemaAdmin front-end controller
 * 
 * CinemaAdmin.php 10/05/2023
 *
 * Copyright (c) 2023 Ian McElwaine <mailto:s3863018@rmit.student.edu.au>
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class CinemaAdmin
{
    /**
     * Apply application settings
     */
    function __construct()
    {
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
        $route = new stdClass();

        // Routes
        $routes = [
            '/' => [
                'View' => 'cinema-admin',
                'Title' => 'Cinema Admin'
            ],
            'index.php' => [
                'View' => 'cinema-admin',
                'Title' => 'Cinema Admin'
            ],
            'sessions' => [
                'View' => 'cinema-admin',
                'Title' => 'Cinema Admin'
            ],
            'movies' => [
                'View' => 'browse-movies',
                'Title' => 'Movies'
            ],
            'about' => [
                'View' => 'about',
                'Title' => 'About Cinema Admin'
            ]
        ];

        // Catch show-stopper exceptions at top of stack
        try {
            // If $_POST data received then route request to controller
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                $route = PostRouter::route();
            else {
                // Find the view
                if ((isset($_GET['page'])) and (array_key_exists($_GET['page'], $routes))) {
                    $route->View = __DIR__ . '/view/views/' . $routes[$_GET['page']]['View'] . '.view.php';
                    $route->Title = $routes[$_GET['page']]['Title'];
                } else {
                    $route->View =  __DIR__ . '/view/views/session-admin.view.php';
                    $route->Title = "Cinema Admin";
                }
            }
        }

        // Catch bad requests to the controllers
        catch (BadRequestException $e) {
            header("Location: /index.php");
        }

        // Catch unexpected exceptions and notify user
        catch (Exception $e) {
            global $errorMessage;
            $errorMessage = $e->getMessage();
            $route = new stdClass();
            $route->Title = "Error";
            $route->View = __DIR__ . '/view/views/error.view.php';
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
