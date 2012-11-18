<?php
/* 
 * The main handler for all web requests.
 * 
 * 
 */

/**
 * get the passed request.
 */
$request = $_SERVER['QUERY_STRING'];

/**
 * break the query string a part.
 * 
 */
$parse_request = explode("&", $request);

$page = array_shift($parse_request);

$page = explode("=", $page);

$page = $page[1];

// check if rest or soap request

switch($page) {
    case 'rest' :
        // prepare a rest response
        require_once("restutils.php");
        break;
    case 'soap' :
        //require_once("soap.php");
        //return;
        // prepare a rest response
        break;
    default :
        // do nothing.
}

// define the variables
$vars = array();

foreach ($parse_request as $arg) {
    // break the variable and value apart
    list($variable, $value) = preg_split("/\=/", $arg);
    $vars[$variable] = urldecode($value);
}

// load the correct controller
$controller_target = SERVER_ROOT . DS . 'controller' . DS . $page . '.php';

// check if the target controller exists.
if (file_exists($controller_target)) {
    include_once($controller_target);
    $class = ucfirst($page) . '_Controller';

    if(class_exists($class)) {
        $controller = new $class;
    } else {
        print "bad";
        exit;
    }
} else {
    print "404";
    exit;
}

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    $controller->main($vars, 'json');
} else {
    $controller->main($vars);
}