<?php
/* 
 * 
 */
class Main_Model
{
    /**
     * @var private object $database;
     */
    private $database;

    public function __construct() {
        // load the mysqli driver
        $this->database = new Mysqli_Driver_Library();
    }

    /**
     * retrieve the data from the db. return the desired user information.
     * @param int $id
     * @return array
     */
    public function getData($id) {
        $this->database->connect();

        // check data. sanatize.
        $id = $this->database->escape($id);

        $this->database->prepare(
            "
            SELECT 
                *
            FROM
                status
            WHERE
                users_id = '$id'
            ORDER BY
                updateTime desc
            LIMIT
                5;
            "
        );

        // run the query
        $this->database->query();
        while($data = $this->database->fetch()) {
            $datas[] = $data->status . " " . $data->updateTime;
        };
        return $datas;
    }

    // save the status update.
    public function saveData($id, $statusMsg) {
        $this->database->connect();

        // check data. sanatize.
        $id = $this->database->escape($id);
        $status = $this->database->escape($statusMsg);

        $this->database->prepare(
            "
            INSERT INTO
                status
                (users_id, status, updateTime)
            VALUES
                ({$id}, '{$statusMsg}', NOW())
            "
        );

        // run the query
        return $this->database->query();
    }
}