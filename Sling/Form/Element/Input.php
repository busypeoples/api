<?php

/**
 * 
 * @package Sling
 * @subpackage Form
 */

namespace Sling\Form\Element;

class Input extends AbstractElement {
    
    public function getElement() {
        $output[] =  '<input value="' . $this->getValue() . '" ';
           foreach ($this->getAttributes() as $attribute => $value) {
               $output[] = $attribute . '="' . $value . '" '; 
           }

        $output[] = '/>';
        $this->_output = implode('', $output);
        
        foreach($this->getDecorators() as $decorator) {
            $decorator->setElement($this);
            $this->_output = $decorator->decorate();
        }
        
        return $this->_output;
    }

}
