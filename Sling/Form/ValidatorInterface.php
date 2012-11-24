<?php

/**
 * @package Sling
 * @subpackage Form
 */

namespace Sling\Form;

interface ValidatorInterface {
    public function execute($value);
    public function getMessage();
}
