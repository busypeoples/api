<?php

namespace Sling\Form\Decorator;

class Error extends AbstractDecorator {
    
    /**
     *
     * @var array
     */
    protected $_errors = array();
    
    /**
     * 
     * @param array $errors
     */
    public function __construct($errors) {
        $this->_errors = $errors;
    }
    
    public function decorate() {
        return $this->getElement()->getOutput() . ' <span class="error">' . $this->getMessage() . '</span>';
    }
    
    /**
     * 
     * @param array $error
     * @return \Sling\Form\Decorator\Error
     */
    public function setMessage($errors) {
        $this->_errors = $errors;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getMessage() {
        return implode(' ' , $this->_errors);
    }
    
}
