<?php

namespace Sling;

use Sling\MVC\Request;
use Sling\MVC\Response;
use Sling\System\Command\CommandResolver;
use Sling\System\Filter;
use Sling\System\Filter\FilterChain;

/**
 * FrontController
 *
 * @since 1.0
 */
class FrontController {
    
    private $_resolver;
    protected $_preFilters;
    protected $_postFilters;

    public function __construct($resolver)
    {
        $this->_resolver = $resolver;
        $this->_preFilters = new FilterChain();
        $this->_postFilters = new FilterChain();
    }

    public function handleRequest(Request $request, Response $response)
    {
        $this->_preFilters->processFilters($request, $response);
        /** @var $command System\Command */
        $command = $this->_resolver->getCommand($request);
        $command->execute($request, $response);
        $this->_postFilters->processFilters($request, $response);
        $response->flush();
    }

    public function addPreFilter(Filter\Filter $filter)
    {
        $this->_preFilters->addFilter($filter);
    }

    public function addPostFilter(Filter\Filter $filter)
    {
        $this->_postFilters->addFilter($filter);
    }
}

