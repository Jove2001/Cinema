<?php

namespace CinemaClient\Controller;

use CinemaClient\Controller\DynamoDbConnection;
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
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
        $dynamoDb = (new DynamoDbConnection())->connect();

        $results = $dynamoDb->scan(
            [
                'TableName' => 'Sessions'
            ]
        );
        
        return $results['Items'];
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
        $dynamoDb = DynamoDbConnection::connect();
        $marshaler = new Marshaler();
        $booking = $marshaler->marshalItem(
            [
                'date' => $_POST['date'],
                'email' => $_POST['email'],
                'id' => $_POST['id'],
                'tickets' => $_POST['tickets']
            ]
        );

        $params = [
            'TableName' => 'Bookings',
            'Item' => $booking
        ];

        try {
            $dynamoDb->putItem($params);
            $route->Title = "Booking confirmed";
            $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/booking-confirmed.view.php';
        } catch (DynamoDbException $e) {
            $route->Title = "Something went wrong";
            $route->View = $_SERVER['DOCUMENT_ROOT'] . '/src/view/views/error.view.php';
            $route->ErrorMessage = $e->getMessage();
        }
        return $route;
    }
}

/**
 * References
 * 
 * [1] Amazon Web Services. AWS Developer Guide. Amazon. https://docs.aws.amazon.com/amazondynamodb/latest/developerguide
 * [2] Dynobase. 13 DynamoDB PHP Query Examples. Dynobase. https://dynobase.dev/dynamodb-php/
 */
