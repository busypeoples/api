<?php

/**
 * @package Sling
 * @subpackage MVC
 */    

namespace Sling\MVC\Data;

class EntityManager {
    
    /** @var UnitOfWorkFactory */
    protected $_unit_of_work_factory;
    
    /** @var array */
    protected $_unit_of_works = array();
    
    /** @var AbstractUnitOfWork */
    protected $_current_unit_of_work;
    
    /**
     * 
     * @param \Sling\MVC\Data\UnitOfWorkFactory $unit_of_work_factory
     */
    public function __construct(UnitOfWorkFactory $unit_of_work_factory) {
        $this->_unit_of_work_factory = $unit_of_work_factory;
        $this->init();
    }
    
    public function init() {
        $this->addUnitOfWork('User');
    }
    
    /**
     * 
     * @return UnitOfWorkFactory
     */
    public function getUnitOfWorkFactory() {
        return $this->_unit_of_work_factory;
    }
    
    /**
     * 
     * @param string $key
     * @return \Sling\MVC\Data\EntityManager
     */
    public function addUnitOfWork($key) {
        $key = strtolower($key);
        if (! in_array($key, $this->getUnitOfWorks())) {
            $unit_of_work = $this->getUnitOfWorkFactory()->create($key);
            $this->_unit_of_works[$key] = $unit_of_work;
            $this->setCurrentUnitOfWork($key);
        }
        
        return $this;
    }
    
    /**
     * 
     * @param array $unit_of_works
     * @return \Sling\MVC\Data\EntityManager
     */
    public function addUnitOfWorks(array $unit_of_works) {
        if (! empty($unit_of_works)) {
            foreach($unit_of_works as $unit_of_work) {
                $this->addUnitOfWork($unit_of_work);
            }
        }
        
        return $this;
    }
    
    /**
     * 
     * @return array
     */
    public function getUnitOfWorks() {
        return $this->_unit_of_works;
    }
    
    /**
     * 
     * @param string $key
     * @return \Sing\MVC\Data\EntityManager
     */
    public function setCurrentUnitOfWork($key) {
        if (!array_key_exists($key, $this->getUnitOfWorks())) {
            throw new Exception\EntityManagerException('Non valid Unit Of Work specified.');
        }
        
        $this->_current_unit_of_work = $key;
        return $this;
    }
    
    /**
     * 
     * @return UnitOfWork
     */
    public function getCurrentUnitOfWork() {
        
        if ($this->_current_unit_of_work === null) {
            throw new Exception\EntityManagerException('No current unit of work specified.');
        }
        return $this->_current_unit_of_work;
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractEntity $entity
     */
    public function setNew(AbstractEntity $entity) {
        $this->getCurrentUnitOfWork()->setAsNew($entity);
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractEntity $entity
     */
    public function setClean(AbstractEntity $entity) {
        $this->getCurrentUnitOfWork()->setAsNew($entity);
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractEntity $entity
     */
    public function setUsed(AbstractEntity $entity) {
        $this->getCurrentUnitOfWork()->setAsUsed($entity);
    }
    
    /**
     * 
     * @param \Sling\MVC\Data\AbstractEntity $entity
     */
    public function setRemoved(AbstractEntity $entity) {
        $this->getCurrentUnitOfWork()->setAsRemoved($entity);
    }
    
    /**
     * clear all new entities.
     */
    public function clearNew() {
        $this->getCurrentUnitOfWork()->clearClean();
    }
    
    /**
     * clear all clean entities
     */
    public function clearClean() {
        $this->getCurrentUnitOfWork()->clearClean();
    }
    
    /**
     * clear all used entities
     */
    public function clearUsed() {
        $this->getCurrentUnitOfWork()->clearUsed();
    }
    
    /**
     * clear all removed entities
     */
    public function clearRemoved() {
        $this->getCurrentUnitOfWork()->clearRemoved();
    }
    
    /**
     * 
     * @return void
     */
    public function clearAll() {
        
        if (empty($this->getUnitOfWorks())) {
            return;
        }
        
        /** @var AbstractUnitOfWork $unit_of_work  */
        foreach($this->getUnitOfWorks() as $unit_of_work) {
            $unit_of_work->clearAll();
        }
    }
    
    /**
     * 
     * @param integer $id
     * @return AbstractEntity|null
     */
    public function findById($id) {
        return $this->getCurrentUnitOfWork()->findById($id);
    }
    
    /**
     * 
     * @return array|null
     */
    public function findAll() {
        return $this->getCurrentUnitOfWork()->findAll();
    }
    
    public function commit() {
        if (empty($this->getUnitOfWorks())) {
            return;
        }
        
        /** @var Sling\MVC\Data\AbstractUnitOfWork $unit_of_work */
        foreach($this->getUnitOfWorks() as $unit_of_work) {
            $unit_of_work->commit();
        }
    }
}

