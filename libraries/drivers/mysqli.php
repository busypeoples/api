<?php
/* 
 * enable interaction with mysql library.
 * @package REST_API
 * @version 1.0
 */
class Mysqli_Driver_Library extends Database_Library {

    /**
     * @var private $connection - the mysqli ressource.
     */
    private $connection;

    /**
     * @var private $query
     */
    private $query;

    /**
     * @var private $return - the result returned.
     */
    private $return;

    public function __construct() {
    }

    public function connect() {
        // start connecting by creating a new mysqli connection.
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PW, DB_DATABASE);
        // check if connection error
        if ($this->connection->connect_errno) {
            die('Connect Error: ' . $mysqli->connect_errno);
        }
    }

    /**
     * @access public
     * @param String $statement
     * @return Boolean
     */
    public function prepare($statement) {
        $this->query = $statement;
        return TRUE;
    }
    
    /**
     * @access public
     * @param String $statement
     * @return Boolean
     */
    public function query() {
       // check if $query is set.
       if(isset($this->query)) {
           $this->return = $this->connection->query($this->query);
           if($this->connection->error) {
               print $this->connection->error;
               return FALSE;

           }
           return TRUE;
       }
       // if $query is not defined
       return FALSE;
    }

    /**
     * @access public
     * @param String $case
     * @return Mixed
     */
    public function fetch($case = null) {
        // check if return result is set and not false.
        if(isset($this->return) && $this->return) {
            switch($case) {
                case 'object' :
                    return $this->return->fetch_object();
                break;
                case 'array' :
                    return $this->return->fetch_array();
                break;
                default :
                    return $this->return->fetch_object();
                break;
            }
        }
    }


    /**
     * Sanitize data to be used in a query
     *
     * @param $data
     */
    public function escape($data)
    {
        return $this->connection->real_escape_string($data);
    }
    
    /**
     * disconnect the mysqli ressource.
     * @access public
     * @return Boolean
     */
    protected function disconnect() {
       $this->connection->close();
       return TRUE;
    }
}