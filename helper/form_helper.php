<?php

/**
 * @package Labelmanager
 * @subpackage Helper
 * form helper class
 *
 */

/**
 * creates form
 * @param array $page - target page
 * @param array $forms - the input forms
 * @param array $type - the page type
 * @access public
 * @return String the complete input text field
 */
function buildForm($page, $forms, $type) {
    $input = "<form id='" . $page . "Form' method='post' action='" . BASE_HTTP . DS .$page . DS . $type . "'>";
    foreach($forms as $form) {
        $input .= $form . "<br/>\n";
    }
    $input .= "</form>";
    return $input;
}

function buildAjaxForm($page, $target) {
    $input = "";
    foreach($this->forms as $form) {
        $input .= $form . '<br/>';
    }
    return $input;
}

/**
 * creates the input text
 * @param Array $params - name, id, class, value and size, label.
 * @access public
 * @return String the complete input text field
 */
function input_form_text($params) {
    $inputForm['name'] = 'name';
    $inputForm['id'] = '';
    $inputForm['class']='inputClass';
    $inputForm['value']='';
    $inputForm['size'] = '30';
    $inputForm['label'] = '';
    foreach($params as $key=>$param) {
        $inputForm[$key] = $param;
    }
    $input = "<label class=\"fields\">{$inputForm['label']}</label><input type=\"text\" id=\"{$inputForm['id']}\" class=\"{$inputForm['class']}\" name = \"{$inputForm['name']}\" value=\"{$inputForm['value']}\" size=\"{$inputForm['size']}\">";
    return $input;
}

/**
 * creates the input textarea
 * @param Array $params - name, id, class, value and size, label.
 * @access public
 * @return String the complete input text field
 */
function input_form_textarea($params) {
    $inputForm['name'] = 'name';
    $inputForm['id'] = '';
    $inputForm['class']='inputClass';
    $inputForm['value']='';
    $inputForm['cols'] = '30';
    $inputForm['rows'] = '4';
    $inputForm['label'] = '';
    foreach($params as $key=>$param) {
        $inputForm[$key] = $param;
    }
    $input = "<label class=\"fields\">{$inputForm['label']}</label><textarea type=\"text\" id=\"{$inputForm['id']}\"
                        class=\"{$inputForm['class']}\" name = \"{$inputForm['name']}\" cols=\"{$inputForm['cols']}\"
                        rows=\"{$inputForm['rows']}\">{$inputForm['value']}</textarea>";
    return $input;
}

/*
 * creates the input password
 * @param Array $params - name, id, class, value and size, label.
 * @access public
 * @return String the complete input password field
 */
function input_form_password($params) {
    $inputForm['name'] = 'name';
    $inputForm['id'] = '';
    $inputForm['class']='inputClass';
    $inputForm['value']='';
    $inputForm['size'] = '30';
    $inputForm['label'] = '';
    foreach($params as $key=>$param) {
        $inputForm[$key] = $param;
    }
    $password = "<label class=\"fields\">{$inputForm['label']}</label><input type=\"password\" id=\"{$inputForm['id']}\" class=\"{$inputForm['class']}\" name = \"{$inputForm['name']}\" value=\"{$inputForm['value']}\" size=\"{$inputForm['size']}\">";
    return $password;
}

/**
 * creates the submit button
 * @param Array $params - id, class, value
 * @access public
 * @return String the submit button
 */
function form_submit($params) {
    $inputForm['id'] = '';
    $inputForm['class']='submitBtn';
    $inputForm['value']='submit';
    foreach($params as $key=>$param) {
            $inputForm[$key] = $param;
    }
    $submit = "<input type=\"submit\" id=\"{$inputForm['id']}\" class=\"{$inputForm['class']}\" value=\"{$inputForm['value']}\"/>";
    return $submit;
}