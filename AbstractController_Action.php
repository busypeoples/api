<?php

namespace Sling;

/**
 * Abstract controller class
 */
abstract class AbstractController_Action implements ControllerInterface {
    
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
    public function setRequest(Request $request) {
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
    public function setResponse(Response $response)
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
    
}
