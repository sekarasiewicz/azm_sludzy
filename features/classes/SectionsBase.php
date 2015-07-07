<?php

require_once (dirname(dirname(__FILE__)).'/config/db.php');

abstract class SectionsBase
{

    abstract protected function count();

    /**
     * @var object The database connection
     */
    private $db_connection = null;

    /**
     * @var array Collection of error messages
     */
    public $errors = array();

    /**
     * Connect
     */

    public function connect()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if ($this->db_connection->connect_errno) {
            $this->errors[] = "Database connection problem.";
        }
    }

    public function fetch($sql)
    {
        $result_of_login_check = $this->db_connection->query($sql);
        if ($result_of_login_check->num_rows > 0) {
            $objArray = array();
            while ($obj = $result_of_login_check->fetch_object()) {
                $objArray[] = $obj;
            }
             return $objArray;
        } else  {
            $this->errors[] = "No Results !";
            return false;
        }
    }

    public function to_string()
    {
        return get_class($this);
    }
}


