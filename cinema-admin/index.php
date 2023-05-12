<?php

/**
 * Cinema-admin application entrypoint
 * 
 * index.php 10/05/2023
 *
 * Copyright (c) 2023 Ian McElwaine <mailto:s3863018@rmit.student.edu.au>
 *
 * This software is the original academic work of Ian McElwaine.
 * It has been prepared for submission to RMIT University
 * as assessment work for COSC2639 Cloud Computing
 */

session_start();
require_once __DIR__ . '/vendor/autoload.php';

use CinemaAdmin\CinemaAdmin;

$ca = new CinemaAdmin();
$ca->run();
