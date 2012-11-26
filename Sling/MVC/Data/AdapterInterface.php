<?php

/**
 * @package Sling
 * @subpackage MVC
 */

namespace Sling\MVC\Data;

interface AdapterInterface {
    public function connect();
    public function disconnect();
    public function query($query);
    public function fetch();
    public function select($table, $conditions = '', $fields = '*', $order = '', $limit = null, $offset = null);
    public function insert($table, array $data);
    public function update($table, array $data, $conditions);
    public function delete($table, $conditions);
    public function getInsertedId();
    public function countRows();
    public function getAffectedRows();
}

