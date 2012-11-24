<?php

namespace Sling\Form;

/**
 * @package Sling
 * @subpackage Form
 */

interface ElementInterface {
    public function setValue($value);
    public function getValue();
    public function addDecorator(DecoratorInterface $decorator);
    public function setDecorators(array $decorators);
    public function getDecorators();
    public function addValidator(ValidatorInterface $validator);
    public function setValidators(array $validators);
    public function getValidators();
    public function addAttribute($attribute, $value);
    public function setAttributes(array $attributes);
    public function getAttributes();
    public function getElement();
    public function validate();
}
