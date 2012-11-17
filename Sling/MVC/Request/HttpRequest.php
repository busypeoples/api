<?php

namespace Sling\MVC\Request;

/**
 * HttpRequest
 *
 * @since 1.0
 */
class HttpRequest implements \Sling\MVC\RequestInterface  {
    
    private $_parameters;

    /**
     * constructor
     */
    public function __construct() {
        $this->_parameters = $_REQUEST;
    }

    public function getParameterNames() {
        return array_keys($this->_parameters);
    }

    public function hasParameter($name) {
        if (array_key_exists($name, $this->_parameters)) {
            return true;
        }

        return false;
    }
    
    public function getController() {
        return 'main';
        if ( ! count($this->_parameters) > 0) {
            return false;
        }
        return $this->_parameters[0];
    }

    public function getParameter($name) {
        if ($this->issetParameter($name)) {
            return $this->_parameters[$name];
        }

        return null;
    }

    public function getHeader($name) {
        $name = 'HTTP_' . strtoupper(\str_replace('-', '_', $name));
        if (isset($_SERVER[$name])) {
            return $_SERVER[$name];
        }
        return null;
        
    }

    public function getData() {
        
    }

    public function getHttpAccept() {
        
    }

    public function getMethod() {
        
    }

    public function setController($controller) {
        
    }

    public function setData($data) {
        
    }

    public function setMethod($method) {
        
    }

    public function setParameter($request_vars) {
        
    }
}
