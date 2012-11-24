<?php

namespace Sling\Form\Validator;

class NotEmpty extends AbstractValidator {
    
    const MESSAGE = 'Value is not allowed to be empty.';
    
    /**
     * 
     * @param mixed $value
     * @return boolean
     */
    public function execute($value) {
        
        if (!isset($value)) {
            return false;
        }
        
        if (is_null($value)) {
            return false;
        }
        
        if ($value === '') {
            return false;
        }
        
        return true;
    }
    
    
}