<?php

namespace Sling\Form\Decorator;

class Label extends AbstractDecorator {
    
    /**
     *
     * @var string $_label 
     */
    protected $_label;
    
    /**
     * 
     * @param string $label
     */
    public function __construct($label) {
        $this->_label = $label;
    }
    
    public function decorate() {
        return '<label for ="' . $this->getElement()->getName() . '" >' . 
                $this->_label . '</label>' . 
                $this->getElement()->getOutput();
    }
}
