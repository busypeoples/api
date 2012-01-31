<?php
/**
 * main front end user controller.
 * @package REST_API
 * @subpackage Controller
 * @version 1.0
 */
class Main_Controller {

    public $tmp = 'main';

    /**
     * @param array $vars - all get variables.
     */
    public function main(array $vars, $reqType = null) {
        
        // check if user is logged in.
        try {
           $session = new Session_Library();
           $session->validate();
           $session->session_open();
           $this->session_user = $session->session_read('id');
        } catch(Exception $e) {
            header('location:' . BASE_HTTP . '/login');
        }
        
        if($reqType == 'json') {
            self::updateJson($_POST['status']);
            return;
        }
        
        $mainModel = new Main_Model;
        // load the string helper
        Loader::load('string');
         // get the data from the model.
        try {
        $data = $mainModel->getData(1);
        $header = new View('header');
        $footer = new View('footer');
        $main = new View($this->tmp);
        $main->assign('title', 'hello user ' . $this->session_user);
        $main->assign('content', $data);
        $main->assign('form', $this->addForm());
        $main->assign('footer', $footer->build('false'));
        $main->assign('header', $header->build('false'));
        $main->build();
        } catch(Exception $e) {
            print "404 " . $e->getMessage() . " " . $e->getLine();
        }
    }

    /**
     * handles a update status json request.
     * @access public
     * @return array $data
     */
    public function updateJson($data) {
        $mainModel = new Main_Model;
        if($mainModel->saveData(1, $data)) {
            $data = $mainModel->getData(1);
            echo json_encode(array('status' => $data));
        } else {
            echo json_encode(array('msg' => 'something went wrong'));
        }
    }

    
    protected function addForm() {
        // build a form array
        $forms = array();

        // load the form helper
        Loader::load('form');

        $attributes = array (
                'id' => 'update',
                'name' => '',
                'size' => '24',
                'value' => '',
                'label' => 'update'
        );

        $forms[] = input_form_textarea($attributes);

        $attributes = array (
                'id' => 'submit',
                'value' => 'Submit Update'
        );
        $forms[] = form_submit($attributes);

        // create the form field

        return buildForm('main', $forms, 'updateJson');
    }
}