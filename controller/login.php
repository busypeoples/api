<?php
/**
 * user front end login.
 * validate username and password.
 * @package REST_API
 * @subpackage controller
 * @version 1.0
 */
class Login_Controller extends Controller {

     public $tmp = 'login';
     
     /**
      *
      * @var Object $session 
      */
     protected $session = null;
     
    /**
     * main function.
     * @param array $request - all get variables.
     */
     public function main(array $request, $reqType = null) {
        parent::__construct($request);
        // load the session library.
        try {
            $this->session = new Session_Library();
            if($this->session->validate()) {
                header('location:' . BASE_HTTP . '/main' );
            }
           
        } catch(Exception $e) {
            // @todo a fallback
        }

        if($reqType == 'json') {
            $this->submitJson();
            return;
        }
        
        $this->content[] = $this->addForm();
        if(isset($request['type']) && $request['type'] == 'submit') {
            $this->submit();
        } else {
            $this->content[] = 'hello';
        }
        

        try {
            $header = new View('header');
            $footer = new View('footer');
            $main = new View($this->tmp);
            $main->assign('title', 'login');
            $main->assign('content', implode("<br/>",$this->content));
            $main->assign('footer', $footer->build('false'));
            $main->assign('header', $header->build('false'));
            $main->build();
        } catch(Exception $e) {
            print "404 " . $e->getMessage() . " " . $e->getLine();
        }
    }

     protected function submit() {
        // check against db
        $loginModel = new Login_Model();
        // connect with the db.
        $data = $loginModel->getData($_POST['username'], $_POST['password']);
        // Load::library('Sessions');
        if(isset($data) && $data !== NULL && $data['id'] > 0) {
            // @todo set cookies for the validated user
            try {
            $this->session = new Session_Library(1);
						$this->session->set();
            $this->session->session_open();
            $this->session->session_init(1);
            $this->session->session_write('user_name', $_POST['username']);
            header('location: ' . BASE_HTTP . '/main');
            } catch(Exception $e) {
                print $e->getMessage();
            }

        } else {
            // return errors
            $this->content[] = "<font color=\"red\"> Sorry. Can not find a user with the name : " . $_POST['username'] . " and the password combination.</font>";
        }
    }

    protected function submitJson() {
         $loginModel = new Login_Model();
        // connect with the db.
        $data = $loginModel->getData($_POST['username'], $_POST['password']);
        // Load::library('Sessions');
        if(isset($data) && $data !== NULL && $data['id'] > 0) {
            // @todo set cookies for the validated user
            $this->session = new Session_Library(1);
            $this->session->session_open();
            $this->session->session_init(1);
            $this->session->session_write('user_name', $_POST['username']);
            $this->session->set();
            $val = array('hello' => 'ok');
            echo json_encode($val);
            $this->redirect('/main');
        } else {
            // return errors
            $feedback = "<font color=\"red\"> Sorry. Can not find a user with the name : " . $_POST['username'] . " and the password combination.</font>";
            $val = array('hello' => $feedback);
            echo json_encode($val);
        }
        
    }

    protected function redirect($target) {
        header('HTTP 1.1 OK 200');
        header('location: ' . BASE_HTTP . $target);
    }

    protected function addForm() {
        // build a form array
        $forms = array();

        // load the form helper
        Loader::load('form');

        $attributes = array (
                'id' => 'name',
                'name' => 'username',
                'size' => '24',
                'value' => '',
                'label' => 'Name'
        );
        
        $forms[] = input_form_text($attributes);

        $attributes = array (
                'id' => 'password',
                'name' => 'password',
                'size' => '24',
                'value' => '',
                'label'=> 'Password'
        );
        $forms[] = input_form_password($attributes);


        $attributes = array (
                'id' => 'submit',
                'value' => 'Login'
        );
        $forms[] = form_submit($attributes);

        // create the form field

        return buildForm('login', $forms, 'submit');
    }
}