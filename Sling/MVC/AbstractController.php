<?php

namespace Sling\MVC;

use Sling\MVC\View\View;

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
     * @var View
     */
    protected $_view;
    
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
        $this->setRequest($request);
        $this->setResponse($response);
        $method = $request->getMethod();
        if (! $method || ! method_exists($this, $method)) {
            $method = 'index';
        }
        $this->$method();
        $response->write($this->getView()->render());
    }
    
    public function setView(View $view) {
        $this->_view = $view;
        return $this;
    }
    
    public function getView() {
        return $this->_view;
    }
    
}
