<?php

namespace CinemaClient\Controller;

/**
 * Defines data access to the backend
 */
interface BackEndInterface
{
    /**
     * @return array of sessions
     */
    public static function get_sessions();

    /**
     * @param ASSOC array the booking data
     */
    public static function confirm_booking($booking);
}
