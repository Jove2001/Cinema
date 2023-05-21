<?php

namespace CinemaClient\View;

use stdClass;

/**
 * Determines view routes
 * 
 * Router.php 04/04/2023
 *
 * Copyright (c) 2023 Ian McElwaine <mailto:s3863018@rmit.student.edu.au>
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class Router
{

    /**
     * View routes.
     * Valid page requests for logged-in / logged out users.
     */
    private const ROUTES = array(
        '/' => array(
            'View' => 'cinema-client',
            'Title' => 'Cinema'
        ),
        'index.php' => array(
            'View' => 'cinema-client',
            'Title' => 'Cinema'
        ),
        'home' => array(
            'View' => 'cinema-client',
            'Title' => 'Cinema'
        ),
        'about' => array(
            'View' => 'about',
            'Title' => 'About Cinema Client'
        )
    );

    /**
     * Get a view route
     * 
     * @return stdClass containing View page route
     */
    static function route()
    {
        $route = new stdClass();

        if ((isset($_GET['page'])) and (array_key_exists($_GET['page'], self::ROUTES))) {
            $route->View = __DIR__ . '/views/' . self::ROUTES[$_GET['page']]['View'] . '.view.php';
            $route->Title = self::ROUTES[$_GET['page']]['Title'];
        } else {
            $route->View =  __DIR__ . '/views/cinema-client.view.php';
            $route->Title = "Cinema";
        }

        return $route;
    }
}
