<?php

namespace Sling;

/**
 * @package REST_API
 */
interface ControllerInterface {
    /**
     * 
     * @param Request $request
     */
    public function setRequest($request);
   
    /**
     * @return Request
     */
    public function getRequest();
    
    /**
     * 
     * @param Response $response
     */
    public function setResponse($response);
    
    /**
     * @return Response
     */
    public function getResponse();
}