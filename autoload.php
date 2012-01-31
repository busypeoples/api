<?php

/**
 * autoload function
 */
function __autoload($class) {
    // break apart folder and class name
    if(strpos($class, '_')) {
        list($file, $folder) = preg_split("/\_/", $class);
        // make sure $folder is lowercase
        $folder = strtolower($folder);
				$file = strtolower($file);	
        switch($folder) {
            case 'driver' :
                $folder = 'libraries' . DS . 'drivers';
            break;
            case 'library' :
                $folder = 'libraries';
            break;
            default :
                // do nothing;
            break;
        }
        // construct the correct path.
        $source = SERVER_ROOT . DS . $folder . DS . $file . '.php';
    } else {
        $class = strtolower($class);
        $source = SERVER_ROOT . DS . strtolower($class) . '.php';
    }
    
    // check if $source exists
    if(file_exists($source)) {
        require_once($source);
    } else {
        print "404 - no file {$source} exists.";
        die();
    }
}