<?php

/**
 * @package Sling
 * @subpackage MVC
 */

namespace Sling\MVC\Data;

abstract class AbstractCollection implements \Countable, \Iterator, \ArrayAccess {
    
    /** @var array */
    protected $_entities = array();
    
    /** @var $_entity_class */
    protected $_entity_class;

    /**
     * 
     * @return array
     */
    public function getEntities() {
        return $this->_entities;
    }
    
    /**
     * clear the entities array
     */
    public function clear() {
        $this->_entities = array();
    }
    
    /**
     * reset the position back to the start
     */
    public function rewind() {
        reset($this->getEntities());
    }
    
    /**
     * 
     * @return AbstractEntity
     */
    public function current() {
        return current($this->getEntities());
    }
    
    /**
     * next implementation
     */
    public function next() {
        next($this->getEntities());
    }
    
    /**
     * 
     * @return mixed
     */
    public function key() {
        return key($this->getEntities());
    }
    
    /**
     * 
     * @return boolean
     */
    public function valid() {
        return (boolean) ($this->current() !== false);
    }
    
    /**
     * 
     * @param mixed $key
     * @return boolean
     */
    public function offsetExists($key) {
        return array_key_exists($key, $this->getEntities());
    }
    
    /**
     * 
     * @param mixed $key
     * @return AbstractEntity|null
     */
    public function offsetGet($key) {
        if ($this->offsetExists($key)) {
            return $this->_entities[$key];
        }
        
        return null;
    }
    
    /**
     * 
     * @param mixed $key
     * @param \Sling\MVC\Data\_entity_class $entity
     * @return boolean
     * @throws ´\Exception
     */
    public function offsetSet($key, $entity) {
        if ($entity instanceof $this->_entity_class) {
            if (!isset($key)) {
                $this->_entities[] = $entity;
            } else {
                $this->_entities[$key] = $entity;
            }
            return true;
        }
        
        throw new ´\Exception('The entity is not allowed to be added this collection.');
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\_entity_class $key
     * @return boolean
     */
    public function offsetUnset($key) {
        if ($key instanceof $this->_entity_class) {
            $this->_entities = array_filter($this->_entities, function($v) use ($key) {
                return $v !== $key;
            });
            return true;
        }
        
        if (isset($this->_entities[$key])) {
            unset($this->_entities[$key]);
            return true;
        }
        
        return false;
        
    }
    
    /**
     * 
     * @return integer
     */
    public function count() {
        return count($this->getEntities());
    }
    
}

