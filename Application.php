<?php
/* 
 * Main application entry point.
 * Called and instantiated from within the public index.php file.
 *
 */
    
namespace Sling;

/**
 * Main File.
 * Application
 *
 * @since 1.0
 */
class Application {

    protected $_bootstrap;
    protected $_config;
    protected $_settings;
    const VERSION = 1.0;

    /**
     *
     * @param $_config 
     */
    public function __construct($config)
    {
        $this->_config = $config;
    }

    public function bootstrap()
    {
        $this->_parseFile();
        return $this;
    }

    public function run()
    {
        // application entry point
        // setup the request and reponse objects
      
        $request = new \Sling\MVC\Request\HttpRequest();
        $controller = $request->getController();

        if (! $controller) {
            $controller = $this->_settings['default.controller'];
        }
        
        $fileHandler = new \Sling\Command\FileSystemCommandResolver($controller);

        /**
         * @var $response \Sling\System\HttpResponse
         */
        $response = new \Sling\MVC\Response\HttpResponse();
        
        /**
         * @var $view \Sling\MVC\View\View
         */
        $view = new \Sling\MVC\View\View($request->getController());

        $front_controller = new \Sling\FrontController();
        $front_controller->setResolver($fileHandler);
        $front_controller->setView($view);
       // $front_controller->addPostFilter(new System\Filter\UpperCaseFilter());
       //$front_controller->addPostFilter(new System\Filter\WordWrapFilter());
        $front_controller->handleRequest($request, $response);

    }

    protected function _parseFile()
    {
        $this->_settings = parse_ini_file($this->_config);
        
    }

}
