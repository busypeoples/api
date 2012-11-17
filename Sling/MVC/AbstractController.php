<?php

namespace Sling\MVC;

/**
 * Abstract controller class
 */
abstract class AbstractController implements ControllerInterface {
    
    /**
     *
     * @var Request
     */
    protected $_request;
    
    /**
     *
     * @var Response
     */
    protected $_response;
    
    /**
     *
     * @var Service 
     */
    protected $_service;
    
    /**
     * 
     * @param Request $request
     */
    public function setRequest(RequestInterface $request) {
        $this->_request = $request;
        return $this;
    }
    
    /**
     * 
     * @return Request
     */
    public function getRequest() {
        return $this->_request;
    }
    
    /**
     * 
     * @param \Sling\Response $response
     * @return \Sling\AbstractController_Action
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->_response = $response;
        return $this;
    }
    
    /**
     * 
     * @return Response
     */
    public function getResponse() {
        return $this->_response;
    }
    
    /**
     * 
     * @param \Sling\Service $service
     * @return \Sling\AbstractController_Action
     */
    public function setService(Service $service)
    {
        $this->_service = $service;
        return $this;
    }
    
    /**
     * 
     * @return Service
     */
    public function getService()
    {
        return $this->_service;
    }
    
    public function execute(\Sling\MVC\RequestInterface $request, \Sling\MVC\ResponseInterface $response) {
        if ($request->hasParameter('name')) {
            $view = new \Sling\View\HtmlTemplateView('helloWorld');
            $view->name = $request->getParameter('name');
            $view->render($request, $response);
        } else {
            $response->write('hello guest user.');
        }
    }
    
}
