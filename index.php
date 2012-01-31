<?php

/**
 * The front controller.
 * Starting point for the application.
 * All requests go through index.php
 * @package REST_API
 * @version 1.0
 *
 */

/**
 * the so called web root folder
 */

define('SERVER_ROOT', '');

define('BASE_HTTP', '');

// include the config file
require_once('config.php');

// include the autoloader
require_once('autoload.php');

// include the router
require_once('router.php');