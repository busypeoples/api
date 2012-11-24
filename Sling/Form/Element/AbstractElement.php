<?php

/**
 * @package Sling
 * @subpackage Form
 */

namespace Sling\Form\Element;

use Sling\Form\ElementInterface,
    Sling\Form\ValidatorInterface,
    Sling\Form\DecoratorInterface;

abstract class AbstractElement implements ElementInterface {
    
    /**
     * @var string
     */
    protected $_value;
    
    /**
     * @var array $_decorators
     */
    protected $_decorators = array();
    
    /**
     *
     * @var array $_validators
     */
    protected $_validators = array();
    
    /**
     *
     * @var array $_attributes
     */
    protected $_attributes = array();
    
    /**
     *
     * @var string
     */
    protected $_output;
    
    /**
     * @var string $_name;
     */
    protected $_name;
    
    /**
     *
     * @var boolean
     */
    protected $_required;
    
    /**
     *
     * @var string
     */
    protected $_class;
    
    /**
     *
     * @var array
     */
    protected $_errors = array();
    
    public function __construct($name) {
        $this->setName($name);
    }

    /**
     * 
     * @param string $value
     * @return \AbstractElement
     */
    public function setValue($value) {
        $this->_value = $value;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getValue() {
        return $this->_value;
    }
    
    /**
     * 
     * @param \Sling\Form\DecoratorInterface $_decorator
     * @return \Sling\Form\AbstractElement
     */
    public function addDecorator(DecoratorInterface $decorator) {
        $this->_decorators[] = $decorator;
        return $this;
    }
    
    /**
     * 
     * @param array $decorators
     * @return \Sling\Form\AbstractElement
     */
    public function setDecorators(array $decorators) {
        $this->_decorators = $decorators;
        return $this;
    }
    
    /**
     * 
     * @return array
     */
    public function getDecorators() {
        return $this->_decorators;
    }
    
    /**
     * 
     * @param \Sling\Form\ValidatorInterface $validator
     * @return \Sling\Form\AbstractElement
     */
    public function addValidator(ValidatorInterface $validator) {
        $this->_validators[] = $validator;
        return $this;
    }
    
    /**
     * 
     * @param array $validators
     * @return \Sling\Form\AbstractElement
     */
    public function setValidators(array $validators) {
        $this->_validators = $validators;
        return $this;
    } 
    
    /**
     * 
     * @return array
     */
    public function getValidators() {
        return $this->_validators;
    }
    
    /**
     * 
     * @param type $attribute
     * @param type $value
     * @return \Sling\Form\AbstractElement
     */
    public function addAttribute($attribute, $value) {
        $this->_attributes[$attribute] = $value;
        return $this;
    }
    
    /**
     * 
     * @param array $attributes
     * @return \Sling\Form\AbstractElement
     */
    public function setAttributes(array $attributes) {
        $this->_attributes = $attributes;
        return $this;
    }
    
    /**
     * 
     * @return array
     */
    public function getAttributes() {
        return $this->_attributes;
    }
    
    /**
     * 
     * @param string $name
     * @return \Sling\Form\Element\AbstractElement
     */
    public function setName($name) {
        $this->_name = $name;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->_name;
    }
    
    public function getOutput() {
        return $this->_output;
    }
    
    public function validate() {

        foreach ($this->getValidators() as $validator) {
            if (!$validator->execute($this->getValue())) {
                $this->_errors[] = $validator->getMessage();
            }
        }
        
        if (count($this->_errors) > 0 ) {
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * @return array
     */
    public function getErrors() {
        return $this->_errors;
    }
    
    /**
     * 
     * @param boolean $required
     * @return \Sling\Form\Element\AbstractElement
     */
    public function setRequired($required) {
        $this->_required = $required;
        return $this;
    }
    
    /**
     * 
     * @return boolean
     */
    public function getRequired() {
        return $this->_required;
    }
    
    public function setClass($class) {
        $this->_class = $class;
        return $this;
    }
    
    public function getClass() {
        return $this->_class;
    }
}
