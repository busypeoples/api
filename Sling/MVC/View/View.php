<?php

namespace Sling\MVC\View;

/*
 * Takes care of the view functionality.
 * @package REST_API
 */
class View {

    /**
     * @access private
     * @var array
     */
    private $_view_data = array();
    
    /**
     *
     * @var String
     */
    protected $_class_name;
    
    /**
     * 
     * @param String $name
     */
    public function __construct($name) {
        $this->_class_name = $name;
    }

    public function __set($key, $value) {
        $this->_view_data[$key] = $value;
    }
    
    public function __get($key) {
        if (array_key_exists($key, $this->getViewData())) {
            return $this->_view_data[$key];
        }
        
        return null;
    }
    
    public function getViewData() {
        return $this->_view_data;
    }
    
    public function render() {
        require_once(APPLICATION_PATH . DS . 'view/header.php');
        // load the template
        require_once(APPLICATION_PATH . DS . 'view' . DS . $this->_class_name . '.php');
        require_once(APPLICATION_PATH . DS . 'view/footer.php');

    }
            
            
    
    public function __destruct() {
    }
}