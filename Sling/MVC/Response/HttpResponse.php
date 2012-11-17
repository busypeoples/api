<?php

namespace Sling\MVC\Response;

use Sling\MVC\ResponseInterface;

/**
 * HttpResponse
 *
 * @since 0.1
 */
class HttpResponse implements ResponseInterface {

    private $_status = '200 OK';
    private $_headers = array();
    private $_body = null;

    public function setStatus($status)
    {
        $this->_status = $status;
    }

    public function addHeader($name, $value)
    {
        $this->_headers[$name] = $value;
    }

    public function write($data)  {
        $this->_body .= $data;
    }

    public function getBody() {
        return $this->_body;
    }

    public function setBody($body) {
        $this->_body = $body;
    }

    public function flush() {
        header('HTTP/1.0 ' . $this->_status);
        foreach( $this->_headers as $name => $value) {
           header($name . ': ' . $value);
        }
        print $this->_body;
        $this->_headers = array();
        $this->_body = null;
    }

    public function getController() {
        
    }

    public function getData() {
        
    }

    public function getHttpAccept() {
        
    }

    public function getMethod() {
        
    }

    public function getParameter($key) {
        
    }

    public function getParameterNames() {
        
    }

    public function hasParameter($key) {
        
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
