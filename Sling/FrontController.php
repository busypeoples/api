<?php

namespace Sling;

use Sling\MVC\RequestInterface;
use Sling\MVC\ResponseInterface;
use Sling\Command\CommandResolver;


/**
 * FrontController
 *
 * @since 1.0
 */
class FrontController {
    
    private $_router;
    private $_resolver;
    protected $_preFilters;
    protected $_postFilters;
    protected $_config;
    protected $_service;
    protected $_bootstrap;
    protected $_view;
    
    /**
     * 
     * @param type $config
     */
    public function __construct($config = null) {
        $this->_config = $config;
    }
    
    public function run()
    {
        
    }
    
    /**
     * 
     * @param \Sling\Command\CommandResolver $resolver
     * @return \Sling\FrontController
     */
    public function setResolver(CommandResolver $resolver) {
        $this->_resolver = $resolver;
        return $this;
    }
    
    /**
     * 
     * @return \Sling\Command\CommandResolver
     */
    public function getResolver() {
        return $this->_resolver;
    }
    
    /**
     * 
     * @param type $config
     * @return \Sling\FrontController
     */
    public function setConfig($config) {
        $this->_config = $config;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    protected function getConfig() {
        return $this->_config;
    }
    
    /**
     * 
     * @param type $router
     * @return \Sling\FrontController
     */
    public function setRouter($router) {
        $this->_router = $router;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function getRouter() {
        return $this->_router;
    }
    
    /**
     * 
     * @param type $filter_chain
     */
    public function setPreFilterChain($filter_chain) {
        $this->_preFilters = $filter_chain;
    }
    
    /**
     * 
     * @return type
     */
    public function getPreFilterChain() {
        return $this->_preFilters;
    }
    
    /**
     * 
     * @param type $fiter_chain
     */
    public function setPostFilterChain($fiter_chain) {
        $this->_postFilters = $filter_chain;
    }
    
    /**
     * 
     * @return type
     */
    public function getPostFilterChain() {
        return $this->_postFilters;
    }
    
    /**
     * 
     * @param \Sling\MVC\View\View $view
     * @return \Sling\FrontController
     */
    public function setView(MVC\View\View $view) {
        $this->_view = $view;
        return $this;
    }
    
    /**
     * 
     * @return \Sling\MVC\View\View
     */
    public function getView() {
        return $this->_view;
    }
    
    /**
     * 
     * @param \Sling\MVC\RequestInterface $request
     * @param \Sling\MVC\ResponseInterface $response
     */
    public function handleRequest(RequestInterface $request, ResponseInterface $response) {
        //$this->_preFilters->processFilters($request, $response);
        /** @var $controller \Sling\Command\CommandResolver */
        $controller = $this->_resolver->getCommand($request);
        $controller->setView($this->getView());
        $controller->execute($request, $response);
        //$this->_postFilters->processFilters($request, $response);
        $response->flush();
    }
    
    /**
     * 
     * @param \Sling\System\Filter\Filter $filter
     */
    public function addPreFilter(Filter\Filter $filter) {
        $this->_preFilters->addFilter($filter);
    }
    
    /**
     * 
     * @param \Sling\System\Filter\Filter $filter
     */
    public function addPostFilter(Filter\Filter $filter) {
        $this->_postFilters->addFilter($filter);
    }
}

