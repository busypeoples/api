<?php

require_once '../index.php';

/* 
 * handles all user related tasks including creation, login, logout and account deletion.
 * @package Labelmanager
 * @subpackage Library
 * @since 0.1
 */
class User {

    protected $values;
    protected $user;
    protected $password;
    protected $email;
    protected $label;
    protected $address;
    protected $phone;

    public function  __construct() {
        
    }

    public function create($user, $password, $email, $label, $address = null, $phone = null) {
        $this->user = $user;
        $this->password = $password;
        $this->email = $email;
        $this->label = $label;
        $this->address = $address;
        $this->phone = $phone;
    }

    public function login($user, $password) {

        // check against a db.
        // if true -> session var loggedIn = true and dynamic session id.
        // if true
        $this->user = $user;
        $this->password = $password;
        // sanatize input and check
        
 
    }

    public function logout() {

    }

    public function delete() {

    }
  
}