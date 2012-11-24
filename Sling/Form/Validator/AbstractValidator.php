<?php

/**
 * @package Sling
 * @subpackage Form 
 */

namespace Sling\Form\Validator;

use Sling\Form\ValidatorInterface;

abstract class AbstractValidator implements ValidatorInterface {
    
    const MESSAGE = '';
    
    public function getMessage() {
        return static::MESSAGE;
    }
}
