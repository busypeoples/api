<?php
/* 
 * db login
 */
class Login_Model
{
    /**
     * @var private object $database;
     */
    private $database;

     /**
     * constructor
     * @access public
     */
    public function __construct() {
        // load the mysqli driver
        $this->database = new Mysqli_Driver_Library();
    }

    /**
     * retrieve the data from the db. return the desired user information.
     * @param int $id
     * @return array
     */
    public function getData($username, $password) {
        $this->database->connect();
        // check data. sanatize.
        $username = $this->database->escape($username);
        // md5 the password.
        $password = md5($password);
        $password = $this->database->escape($password);
        // prepare the query.
        $this->database->prepare(
            "
            SELECT
                id
            FROM
                user
            WHERE
                username = '{$username}'
            AND
                password = '{$password}'
            LIMIT
                1;
            "
        );

        // run the query
        $this->database->query();
        $data = $this->database->fetch('array');
        return $data;
    }
}