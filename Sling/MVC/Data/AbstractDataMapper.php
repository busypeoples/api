<?php

/**
 * @package Sling
 * @subpackage MVC
 */

namespace Sling\MVC\Data;

abstract class AbstractDataMapper {
    
    /**  @var AdapterInterface */
    protected $_adapter;
    
    /**  @var AbstractCollection */
    protected $_collection;
    
    /**
     * 
     * constructor
     * 
     * @param \Sling\MVC\Data\AdapterInterface $adapter
     * @param \Sling\MVC\Data\AbstractCollection $collection
     */
    public function __construct(AdapterInterface $adapter, AbstractCollection $collection) {
        $this->_adapter = $adapter;
        $this->_collection = $collection;
        $this->init();
    }
    
    public function init() {
        
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AdapterInterface $adapter
     * @return \Sling\MVC\Data\AbstractDataMapper
     */
    public function setAdapter(AdapterInterface $adapter) {
        $this->_adapter = $adapter;
        return $this;
    }
    
    /**
     * 
     * @return AdapterInterface
     */
    public function getAdapter() {
        return $this->_adapter;
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractCollection $collection
     * @return \Sling\MVC\Data\AbstractDataMapper
     */
    public function setCollection(AbstractCollection $collection) {
        $this->_collection = $collection;
        return $this;
    }
    
    /**
     * 
     * @return AbstractCollection
     */
    public function getCollection() {
        return $this->_collection;
    }
}
