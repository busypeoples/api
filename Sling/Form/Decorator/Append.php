<?php

namespace Sling\Form\Decorator;

class Append extends AbstractDecorator {
    
    /**
     *
     * @var string
     */
    protected $_message;
    
    public function __construct($message, $class = null) {
        $this->_message = $message;
        if ($class !== null) {
            $this->setClass($class);
        }
    }
    
    public function decorate() {
        return $this->getElement()->getOutput() . ' <span class="' . $this->getClass() . '">' . $this->getMessage() . '</span>';
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