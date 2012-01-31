<?php
/*
 * @package REST_API
 * @subpackage helper
 * string functions
 */
/**
 *
 * @param string $str
 */
function countWords($str) {
    return strlen($str);
}

/**
 * @access public
 * @param string $str
 * @return int
 */
function countHowManyWords($str) {
    return str_word_count($str);
}

function wordWrapping($str, $num) {
   return wordwrap($str, $num);
}