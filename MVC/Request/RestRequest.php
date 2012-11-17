<?php

namespace Sling\MVC\Request;

use Sling\RequestInterface;

/**
 * @package REST_API
 * @version 1.0
 *
 */
class RestRequest implements RequestInterface {
    private $request_vars;
    private $data;
    private $http_accept;
    private $method;

    public function __construct() {
        $this->request_vars = array();
        $this->data = '';
        $this->http_accept = (strpos($_SERVER['HTTP_ACCEPT'], 'json') ? 'json' : 'xml');
        $this->method = 'get';
    }

    public function setData($data) {
        $this->data =  $data;
    }

    public function setMethod($method) {
        $this->method = $method;
    }

    public function setRequestVars($request_vars) {
        $this->request_vars = $request_vars;
    }

    public function getData() {
        return $this->data;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getHttpAccept() {
        return $this->http_accept;
    }

    public function getRequestVars() {
        return $this->request_vars;
    }

    public function getController() {
        
    }

    public function getRequestVar($key) {
        
    }

    public function hasRequestVar($key) {
        
    }

    public function setController($controller) {
        
    }

    public function getParameter($key) {
        
    }

    public function getParameterNames() {
        
    }

    public function hasParameter($key) {
        
    }

    public function setParameter($request_vars) {
        
    }
}