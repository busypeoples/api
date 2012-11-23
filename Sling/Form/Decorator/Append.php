<?php

namespace Sling\Form\Decorator;

class Append extends AbstractDecorator {
    
    /**
     *
     * @var string
     */
    protected $_message;
    
    public function __construct($message) {
        $this->_message = $message;
    }
    
    public function decorate() {
        return $this->getElement()->getOutput() . ' <span class="message">' . $this->getMessage() . '</span>';
    }
    
    /**
     * 
     * @param string $message
     * @return \Sling\Form\Decorator\Append
     */
    public function setMessage($message) {
        $this->_message = $message;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getMessage() {
        return $this->_message;
    }
    
}