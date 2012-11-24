<?php

namespace Sling\Form\Validator;

class Email extends AbstractValidator {
    
    const MESSAGE = 'E-Mail Address is not valid.';
    
    /**
     * 
     * @param string $value
     * @return boolean
     */
    public function execute($value) {
        $email_regex = '/[A-z0-9\.\-\]@[A-z0-9\.\-].[A-z]{2,*}/';
        if (preg_match($email_regex, $value, $result)) {
            return true;
        }
        
        return false;
    }
}