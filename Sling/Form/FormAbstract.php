<?php

namespace Sling\Form;

/*
 * handles the form creation
 * 
 * @package Sling
 * @subpackage Form
 */

abstract class FormAbstract {
    
    /**
     * @var array $_elements
     */
    protected $_elements = array();
    
    /**
     *
     * @var string $_name
     */
    protected $_name;
    
    /**
     *
     * @var string $_action
     */
    protected $_action;
    
    /**
     *
     * @var string $_method
     */
    protected $_method;
        
    /**
     *
     * @var string $_class
     */
    protected $_class;
    
    /**
     *
     * @var string $_id
     */
    protected $_id;
    
    public function __construct() {
        $this->init();
    }
    
    /**
     * 
     * @param type $element
     * @param type $name
     * @param array $options
     * @return \Sling\Form\FormAbstract
     */
    public function createElement($element, $name, array $options = null) {
        $class = '\Sling\Form\Element\\' . $element;
        if (! class_exists($class)) {
            throw new \Exception('Form element ' . $element .  ' does not exist.');
        }
        $element = new $class($name);
        $this->_elements[$name] =  $element;
        return $this;
    }
    
    /**
     * 
     * @param type $name
     * @return type
     * @throws \Exception
     */
    public function getElement($name) {
        if (! $this->hasElement($name)) {
            throw new \Exception('No Element with the name' . $name . ' was found.');
        }
        
        return $this->_elements[$name];
    }
    
    /**
     * 
     * @param string $name
     * @return boolean
     */
    public function hasElement($name) {
        if (array_key_exists($name, $this->_elements)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * 
     * @param string $method
     * @return \Sling\Form\FormAbstract
     */
    public function setMethod($method) {
        $this->_method = $method;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getMethod() {
        return $this->_method;
    }
    
    /**
     * 
     * @param string $class
     * @return \Sling\Form\FormAbstract
     */
    public function setClass($class) {
        $this->_class = $class;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getClass() {
        return $this->_class;
    }
    
    /**
     * 
     * @param string $name
     * @return \Sling\Form\FormAbstract
     */
    public function setName($name) {
        $this->_name = $name;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->_name;
    }
    
    /**
     * 
     * @param string $action
     * @return \Sling\Form\FormAbstract
     */
    public function setAction($action) {
        $this->_action = $action;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getAction() {
        return $this->_action;
    }
    
    /**
     * 
     * @param string $id
     * @return \Sling\Form\FormAbstract
     */
    public function setId($id) {
        $this->_id = $id;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getId() {
        return $this->_id;
    }
    
     /**
     * 
     * @return array
     */
    public function getElements() {
        return $this->_elements;
    }
    
    public function __toString() {
        $output[] = $this->prepareForm();
        /** @var \Sling\Form\Element\ElementInterface $element */
        foreach($this->getElements() as $element) {
            $output[] = $element->getElement();
        }
        
        $output[] = '</form>';
        
        return implode("\n", $output);
    }
    
    protected function prepareForm() {
        $form[] = '<form';
        
        if ($this->getAction()) {
            $form[] = ' action="' . $this->getAction() . '"';
        }
        
        if ($this->getMethod()) {
             $form[] = ' method="' . $this->getMethod() . '"';
        }
        
         if ($this->getName()) {
            $form[] = ' name="' . $this->getName() . '"';
        }
        
        if ($this->getClass()) {
            $form[] = ' class="' . $this->getClass() . '"';
        }
        
        if ($this->getId()) {
            $form[] = ' id="' . $this->getId() . '"';
        }
        
        $form[] = '>';
        
        return implode('', $form);
    }
    
}
