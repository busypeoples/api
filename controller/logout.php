<?php

/** 
 * Logout
 * redirect back to the default page
 * @package LabelManager
 * @subpackage Library
 * @since Version 1.0
 */
class Logout_Controller extends Controller {

    public function __construct() {
        parent::__construct();
        
    }
		
		public function main() {
		
				try {
            $cookies = new Session_Library();
            $cookies->logout();
        } catch(Exception $e) {
            //print $e->getMessage();
        }
        header('location: ' . BASE_HTTP . DS . 'login');
		}
}