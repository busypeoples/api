<?php

/**
 * @package Sling
 * @subpackage MVC
 */

namespace Sling\MVC\Data;

class UnitOfWorkFactory {
    
    /**
     * 
     * @param string $name
     * @return \Sling\MVC\Data\unitOfWork
     */
    public function create($name) {
        $entity = ucfirst(strtolower($name));
        $collection = $entity . 'Collection';
        $data_mapper = $entity . 'Mapper';
        $unitOfWork = $entity . 'UnitOfWork';
        return new $unitOfWork(
                new $data_mapper(Adapter\Mysql::getInstance(), new $collection)
        );
    }
}
