<?php

namespace Sling\MVC;

/**
 * @package REST_API
 */
interface ControllerInterface {
    /**
     * 
     * @param Request $request
     */
    public function setRequest(RequestInterface $request);
   
    /**
     * @return Request
     */
    public function getRequest();
    
    /**
     * 
     * @param Response $response
     */
    public function setResponse(ResponseInterface $response);
    
    /**
     * @return Response
     */
    public function getResponse();
}