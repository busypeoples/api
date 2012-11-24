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
    public function __construct($label, $class = null) {
        $this->_label = $label;
        if ($class !== null) {
            $this->setClass($class);
        }
    }
    
    public function decorate() {
        $label =  '<label for ="' . $this->getElement()->getName() . '"';
            if ($this->getClass()) {
                $label .= ' class="' . $this->getClass() . '"';
            }
            $label .= '>';
            $label .= $this->_label . '</label>';
            return $label . $this->getElement()->getOutput();
    }
}
