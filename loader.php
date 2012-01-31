<?php
/* 
 * loader class.
 * @package REST_API
 * @example
 * @access public
 * @static
 */
class Loader {

    /**
     * @var array $registry.
     */
    protected $reqistry;

    protected function __construct() {
        // prevent initiation from outside.
    }

    protected function __clone() {
        // prevent any clone operation.
    }

    /**
     * <code>
     * // load the type_chcek helper
     * Loader::load('type_check');
     * </code>
     * @access publid
     * @static
     * @param string $helper - helper file name
     * @return void
     */
    public static function load($helper) {
        // construct the file name
        $filename = $helper . '_helper.php';
        $file =  SERVER_ROOT . DS . 'helper' . DS . $filename;
        if(file_exists($file)) {
            require_once($file);
        }
    }
}