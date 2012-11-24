<?php

namespace Sling\Form\Element;

class Submit extends AbstractElement {
    
    public function getElement(){
        $input = '<input type="submit" value="' . $this->getValue() . '"';
        if ($this->getClass()) {
            $input .= 'class="' . $this->getClass() . '"';
        } 
        
        $input .= '>';
        
        return $input;
    }

    public function validate() {
        return true;
    }
}
