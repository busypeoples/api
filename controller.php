<?php

/**
 * main controller.
 * @package REST_API
 * @version 1.0
 */
class Controller {

    protected $request = null;
    protected $template = '';
    protected $view = null;
    protected $content = array();
    protected $session_user = '';
    protected $cookie;

    /**
     * constructor.
     * @access public
     */
    public function __construct() {
       // @todo add @param Array $request
    }
}