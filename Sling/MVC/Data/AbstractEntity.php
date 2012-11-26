<?php

/**
 * @package Sling
 * @subpackage MVC
 */

namespace Sling\MVC\Data;

abstract class AbstractEntity {
    
    /** @var array */
    protected $_values = array();
    
    /** @var array */
    protected $_is_allowed_fields = array();
    
    /**
     * 
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
    }
    
    /**
     * 
     * @param string $name
     * @param mixed $value
     * @throws \Exception
     */
    public function __set($name, $value) {
        if (! in_array($name, $this->getAllowedFields())) {
            throw new \Exception('The field ' . $name . ' is not allowed in this entity.');
        }
        
        $setter_method = 'set' . ucfirst($name);
        
        if (method_exists($this, $setter_method) && is_callable(array($this, $setter_method))) {
            $this->$setter_method($value);
        } else {
            $this->_values[$name] = $value;
        }
    } 
    
    /**
     * 
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name) {
        if (! in_array($name, $this->getAllowedFields())) {
            throw new \Exception('The field ' . $name . ' is not allowed in this entity.');
        }
        
        $access_method = 'get' . ucfirst($name);
        if (method_exists($this, $access_method) && is_callable(array($this, $access_method))) {
            return $this->$access_method;
        }
        
        return array_key_exists($name, $this->getValues())? $this->_values[$name] : null; 
    }
    
    /**
     * 
     * @return array
     */
    public function getAllowedFields() {
        return $this->_is_allowed_fields;
    }
    
    /**
     * 
     * @return array
     */
    protected function getValues() {
        return $this->_values;
    }
    
    /**
     * 
     * @return array
     */
    public function toArray() {
        return $this->_values;
    }
    
}
