<?php

namespace Sling\Form\Element;

class Submit extends AbstractElement {
    
    public function getElement(){
        return '<input type="submit" value="go">';
    }
}
