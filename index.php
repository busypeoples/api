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

define('SERVER_ROOT', '/usr/www/users/slingv/hypeyaself.com/framework');

define('BASE_HTTP', 'http://www.hypeyaself.com/framework');

// include the config file
require_once('config.php');

// include the autoloader
require_once('autoload.php');

// include the router
require_once('router.php');