<?php

/**
 * @package Sling
 * @subpackage MVC
 */

namespace Sling\MVC\Data;

abstract class AbstractUnitOfWork {
    
    /** @var array */
    protected $_new_entities = array();
    
    /** @var array */
    protected $_clean_entities = array();
    
    /** @var array */
    protected $_used_entities = array();
    
    /** @var array */
    protected $_removed_entities = array();
    
    /** @var AbstractDataMapper */
    protected $_data_mapper;
    
    /**
     * class contructor
     * 
     * @param \Sling\MVC\Data\DataMapperAbstract $data_mapper
     */
    public function __construct(AbstractDataMapper $data_mapper) {
        $this->_data_mapper = $data_mapper;
    }
    
    /**
     * 
     * @return \Sling\MVC\Data\AbstractDataMapper
     */
    public function getDataMapper() {
        return $this->_data_mapper;
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractEntity $entity
     * @return void
     */
    public function setAsNew(AbstractEntity $entity) {
        $id = $entity->getId();
        
        if ($id === null) {
            return;
        }
            
        if (in_array($entity, $this->getNewEntities())) {
            return;
        }
        if (array_key_exists($id, $this->getCleanEntities())) {
            unset($this->_clean_entities[$id]);
        }

        if (array_key_exists($id, $this->getUsedEntities())) {
            unset($this->_used_entities[$id]);
        }

        if (array_key_exists($id, $this->getRemovedEntities())) {
            unset($this->_removed_entities[$id]);
        }

        $this->_new_entities = $entity;

    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractEntity $entity
     * @return void
     */
    public function setAsClean(AbstractEntity $entity) {
        $this->_removeAsNew($entity);
        
        $id = $entity->getId();
        
        if (! $id) {
            return;
        }
        
        if (array_key_exists($id, $this->getCleanEntities())) {
            return;
        }
        
        if (array_key_exists($id, $this->getUsedEntities())) {
            unset($this->_used_entities[$id]);
        }
        
        if (array_key_exists($id, $this->getRemovedEntities())) {
            unset($this->_removed_entities[$id]);
        }
        
        $this->_clean_entities[$id] = $entity;
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractEntity $entity
     * @return void
     */
    public function setAsUsed(AbstractEntity $entity) {
        $this->_removeAsNew($entity);
        
        $id = $entity->getId();
        
        if (! $id) {
            return;
        }
        
        if (array_key_exists($id, $this->getUsedEntities())) {
            return;
        }
        
        if (array_key_exists($id, $this->getCleanEntities())) {
            unset($this->_clean_entities[$id]);
        }
        
        if (array_key_exists($id, $this->getRemovedEntities())) {
            unset($this->_removed_entities[$id]);
        }
        
        $this->_used_entities[$id] = $entity;
        
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractEntity $entity
     * @return void
     */
    public function setAsRemoved(AbstractEntity $entity) {
        $this->_removeAsNew($entity);
        
        $id = $entity->getId();
        
        if (! $id) {
            return;
        }
        
        if (array_key_exists($id, $this->getDeletedEntities())) {
            return;
        }
        
        if (array_key_exists($id, $this->getCleanEntities())) {
            unset($this->_clean_entities[$id]);
        }
        
        if (array_key_exists($id, $this->getUsedEntities())) {
            unset($this->_used_entities[$id]);
        }
        
        $this->_removed_entities[$id] = $entity;
    }
    
    /**
     * 
     * @return array
     */
    public function getNewEntities() {
        return $this->_new_entities;
    }
    
    /**
     * 
     * @return array
     */
    public function getCleanEntities() {
        return $this->_clean_entities;
    }
    
    /**
     * 
     * @return array
     */
    public function getUsedEntities() {
        return $this->_used_entities;
    }
    
    /**
     * 
     * @return array
     */
    public function getRemovedEntities() {
        return $this->_removed_entities;
    }
    
    /**
     * 
     * @return \Sling\MVC\Data\AbstractUnitOfWork
     */
    public function clearNew() {
        $this->_new_entities = array();
        return $this;
    }
    
    /**
     * 
     * @return \Sling\MVC\Data\AbstractUnitOfWork
     */
    public function clearClean() {
        $this->_clean_entities = array();
        return $this;
    }
    
    /**
     * 
     * @return \Sling\MVC\Data\AbstractUnitOfWork
     */
    public function clearUsed() {
        $this->_used_entities = array();
        return $this;
    }
    
    /**
     * 
     * @return \Sling\MVC\Data\AbstractUnitOfWork
     */
    public function clearRemoved() {
        $this->_removed_entities = array();
        return $this;
    }
    
    /**
     * 
     * @return \Sling\MVC\Data\AbstractUnitOfWork
     */
    public function clearAll() {
        $this->clearNew()
                ->clearClean()
                ->clearUsed()
                ->clearRemoved();
        return $this;
    }
    
    /**
     * 
     * @param integer $id
     * @return AbstractEntity|null
     */
    public function findById($id) {
        if (array_key_exists($id, $this->getCleanEntities())) {
            return $this->_clean_entities[$id];
        }
        
        if (($entity = $this->_data_mapper->findById($id))) {
            $this->setAsClean($entity);
            return $entity;
        }
        return null;
    }
    
    /**
     * 
     * @return array|null
     */
    public function findAll() {
        $collection = $this->_data_mapper->findAll();
        if ($collection) {
            foreach ($collection as $entity) {
                $this->setAsClean($entity);
            }
            
            return $collection;
        }
        return null;
    }
    
    /**
     * commit action
     */
    public function commit() {
        if (! empty($this->getCleanEntities())) {
            foreach ($this->getCleanEntities() as $entity) {
                $this->getDataMapper()->insert($entity);
            }
        }
        
        if (! empty($this->getUsedEntities())) {
            foreach ($this->getUsedEntities() as $entity) {
                $this->getDataMapper()->update($entity);
            }
        }
        
        if (! empty($this->getRemovedEntities())) {
            foreach ($this->getRemovedEntities() as $entity) {
                $this->getDataMapper()->delete($entity);
            }
        }
    }
    
    protected function _removeAsNew(AbstractEntity $entity) {
        if (in_array($entity, $this->getNewEntities())) {
            $new_entities = array();
            foreach ($this->getNewEntities() as $new_entity) {
                if ($entity !== $new_entity) {
                    $new_entities[] = $new_entity;
                }
            }
            
            $this->_new_entities = $new_entities;
        }
    }
    
}
