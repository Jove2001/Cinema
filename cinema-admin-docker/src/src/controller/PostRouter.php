<?php

namespace CinemaAdmin\Controller;

/**
 * $_POST data controller.
 * Routes post data to sub-controllers
 * 
 * PostController.php 04/04/2023
 *
 * Copyright (c) 2023 Ian McElwaine s3863018@rmit.student.edu.au
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */
class PostRouter
{
    /**
     * Route to the controller for the page in $_POST['page']
     * 
     * @throws BadRequestException when the requested page does not have a controller
     * @throws LoginException when the users session has expired
     */
    static function route()
    {
        switch ($_POST['page']) {
            case 'add-session':
                return SessionController::add_session();
                break;
            case 'edit-session':
                return SessionController::edit_session();
                break;
            case 'save-session':
                return SessionController::save_session();
                break;
            default:
                throw new BadRequestException('The ' . $_POST['page'] . ' page controller was not found');
        }
    }
}
