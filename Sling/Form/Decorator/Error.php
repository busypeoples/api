<?php

namespace Sling\Form\Decorator;

class Error extends AbstractDecorator {
    
    /**
     *
     * @var string
     */
    protected $_error;
    
    public function decorate() {
        return $this->getElement()->getOutput() . ' <span class="error">' . $this->getMessage() . '</span>';
    }
    
    /**
     * 
     * @param string $error
     * @return \Sling\Form\Decorator\Error
     */
    public function setMessage($error) {
        $this->_error = $error;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getMessage() {
        return $this->_error;
    }
    
}
