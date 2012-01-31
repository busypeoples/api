<?php
//if(!defined('BASE_HTTP')){
    //header("HTTP 1.1 404 ERROR");
    //echo "you are not allowed to view this page.";
    //die();
//}
// the serveras

require_once('libraries/database.php');
require_once('libraries/drivers/mysqli.php');
require_once('model/main.php');
require_once('config.php');

class SoapClass {

    //protected $userLogged = FALSE;

    public function getItemCount($upc, $user, $pass){
    //in reality, this data would be coming from a database
    //$items = array('12345'=>5,'19283'=>100,'23489'=>234);
    //return $items[$upc];
        if($this->loginUser($user, $pass)) {
            $mainModel = new Main_Model();
            $data = $mainModel->getData(1);
            return $data; //$data;
        } 
    }

    protected function loginUser($username, $userpassword) {
        // check against a db.
         if($username == "demo" && $userpassword == "demo") {
             return TRUE;
         } else {
            throw new SoapFault("Server", "wrong username password combination.");
        }
    }
}


ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
$server = new SOAPServer("service.wsdl");
$server->setClass('SoapClass');
$server->handle();
?>