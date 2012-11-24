<?php

/**
 * @package Sling
 * @subpackage Form
 */

namespace Sling\Form\Decorator;

use Sling\Form\DecoratorInterface,
    Sling\Form\ElementInterface;

abstract class AbstractDecorator implements DecoratorInterface {
    
    /** @var \Sling\Form\ElementInterface */
    protected $_element;
    
    /** @var string $_class */
    protected $_class;
    
    /**
     * 
     * @param \Sling\Form\ElementInterface $element
     * @return \Sling\Form\Decorator\AbstractDecorator
     */
    public function setElement(ElementInterface $element) {
        $this->_element = $element;
        return $this;
    }
    
    /**
     * 
     * @return ElementInterface
     */
    public function getElement() {
        return $this->_element;
    }
    
    public function setClass($class) {
        $this->_class = $class;
        return $this;
    }
    
    public function getClass() {
        return $this->_class;
    }
}
