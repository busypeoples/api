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
    private $viewData = array();

    /**
     * @access private
     * @var String
     */
    private $render = FALSE;

    public function __construct($temp) {
       
        $target = SERVER_ROOT . DS . 'view' . DS . $temp . '.php';
        if(file_exists($target)) {
            $this->render = $target;
        } else {
            Throw new Exception("faile to find the {$target} file. ");
        }
    }

    public function assign($var, $val) {
        $this->data[$var] = $val;
    }

    /**
     * build the view output.
     * @param String $output
     * @return Mixed
     */
    public function build($output = 'direct') {
        if($output != 'direct') {
            ob_start();
        }
        // assign the data
        if(isset($this->data)) {
            $data = $this->data;
        }
        include($this->render);
        if($output != 'direct') {
            return ob_get_clean();
        }
    }

    public function __destruct() {
    }
}