<?php
/*
 * Database interaction.
 * @package 
 * @abstract
 * @version 1.0
 */
abstract class Database_Library {
    abstract protected function connect();
    abstract protected function prepare($id);
    abstract protected function query();
    abstract protected function fetch();
    abstract protected function disconnect();
}
