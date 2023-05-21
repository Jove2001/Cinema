<?php

namespace CinemaClient\Controller;

use CinemaClient\Config\Config;
use stdClass;

/**
 * Contains functions for managing bookings [1][2]
 * 
 * BookingController.php.php 14/05/2023
 *
 * Copyright (c) 2023 Ian McElwaine s3863018@rmit.student.edu.au
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class BookingController
{
    /**
     * Get all sessions
     * @return array of sessions
     */
    public static function get_sessions()
    {
        $sessions = json_decode(file_get_contents(Config::GET_SESSIONS), true);
        return $sessions['Items'];
    }

    public static function book_ticket()
    {
        $route = new stdClass();
        $route->Title = "Book tickets";
        $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/book-ticket.view.php';
        return $route;
    }

    static function confirm_booking()
    {
        $route = new stdClass();

        $params = http_build_query(
            [
                'date' => $_POST['date'],
                'email' => $_POST['email'],
                'id' => $_POST['id'],
                'tickets' => $_POST['tickets']
            ]
        );

        $result = file_get_contents(Config::MAKE_BOOKING . "?" . $params);

        $route->Title = $result;
        $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/booking-confirmed.view.php';

        return $route;
    }
}

/**
 * References
 * 
 * [1] Amazon Web Services. AWS Developer Guide. Amazon. https://docs.aws.amazon.com/amazondynamodb/latest/developerguide
 * [2] Dynobase. 13 DynamoDB PHP Query Examples. Dynobase. https://dynobase.dev/dynamodb-php/
 */
