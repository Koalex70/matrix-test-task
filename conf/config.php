<?php

/**
 *  CONSTANTS
 */
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('MODEL_PATH', ROOT . '/models/');
define('VIEW_PATH', ROOT . '/views/');
define('CONTROLLER_PATH', ROOT . '/controllers/');

/**
 * CONFIGURATION FILES
 */
require_once ('db.php');
require_once ('route.php');

/**
 * MVC PARENTS FILES
 */
require_once MODEL_PATH . 'Model.php';
require_once VIEW_PATH . 'View.php';
require_once CONTROLLER_PATH . 'Controller.php';

Routing::buildRoute();

