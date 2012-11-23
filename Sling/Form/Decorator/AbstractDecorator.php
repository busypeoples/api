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
}
