<?php

namespace Sling;

/**
 * 
 * Registry 
 * 
 * @package Sling
 */
class ServiceContainer {
    
    /**
     *
     * @var array
     */
    protected $_container = array();
    
    /**
     * 
     * @param String $key
     * @param mixed $value
     * @return \Sling\ServiceContainer
     */
    public function set($key, $value) {
        $this->setData($key, $value);
        return $this;
    }
    
    /**
     * 
     * @param String $key
     * @return mixed
     */
    public function get($key) {
        return $this->getData($key);
    }
    
    /**
     * 
     * @param String $key
     * @return boolean
     */
    public function has($key) {
        return $this->hasData($key);
    }
    
    /**
     * 
     * @param String $key
     * @param mixed $value
     * @return \Sling\ServiceContainer
     */
    protected function setData($key, $value) {
        if (! is_string($key)) {
            throw new \Exception('Provided key must be of type string.');
        }
        
        $this->_container[$key] = $value;
    }
    
    /**
     * 
     * @param String $key
     * @return boolean
     */
    protected function hasData($key) {
        if (array_key_exists($key, $this->getContainer())) {
            return true;
        }
        
        return false;
    }
    
    /**
     * 
     * @param String $key
     * @return boolean
     */
    protected function getData($key) {
        if ($this>hasData($key)) {
            return $this->_container[$key];
        }
        return false;
    }
    
    /**
     * 
     * @return array
     */
    protected function getContainer() {
        return $this->_container;
    }
    
}

