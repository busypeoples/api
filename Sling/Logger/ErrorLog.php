<?php

namespace Sling\Logger;

/**
 * @access public
 *
 */
class ErrorLog implements Logs {

    private static $instance = null;
    protected $logs = array();


    private final function __construct() {
            // protected from outside.
    }


    /**
     * clone function
     * @access private
     * @return void
     */
    private final function __clone() {
            // prevent clone operations
            // do nothing
    }


    /**
     * Enable access
     * call the ErrorLog:
     *<example>$error_log = ErrorLog::getInstance();</example>
     *
     * @access public
     * @static
     * @return object
     */
    public static function getInstance() {
        if(self::$instance == null) {
                self::$instance = new ErrorLog();
        }

        return self::$instance;
    }

    /**
     * setter method
     * @access public
     * @param string $logData
     * @return void
     */
    public function setLogs($logData) {
        $this->logs[] = $logData;
    }

    /**
     * simple getter method
     * @access public
     * @return array
     */
    public function getLogs() {
        return $this->logs;
    }


    /**
     * @access public
     * @return integer
     */
    public function getLogLength() {
        return count($this->logs);
    }

}
