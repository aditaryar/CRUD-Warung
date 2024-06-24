<?php
class Database {
    private $con;
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db = "warung2";

    public function __construct() {
        $this->start_con();
    }

    private function start_con() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->con->connect_error) {
            die('Can not connect mysql server local: ' . $this->con->connect_error);
        }
    }

    public function close_con() {
        return $this->con->close();
    }

    public function sqlquery($sql) {
        return $this->con->query($sql);
    }

    public function jumrec($sql) {
        if ($hasil = $this->sqlquery($sql))
            $jum = $hasil->num_rows;
        else    
            $jum = 0;
        return $jum;
    }

    public function datasql($sql) {
        $data = array();
        if ($hasil = $this->sqlquery($sql))
            $data = $hasil->fetch_array(MYSQLI_BOTH);
        return $data;
    }

    public function fetchdata($sql) {
        $res = array();
        if ($hasil = $this->sqlquery($sql))
            while ($data = $hasil->fetch_array(MYSQLI_BOTH)) {
                $res[] = $data;
            }
        return $res;
    }

    public function get_error() {
        return $this->con->error;
    }

    public function beginTransaction() {
        $this->con->autocommit(FALSE);
    }
    
    public function rollbackTransaction() {
        $this->con->rollback();
    }
    
    public function insert_id() {
        return $this->con->insert_id;
    }
    
    public function commitTransaction() {
        $this->con->commit();
    }

    public function begin_transaction() {
        $this->con->begin_transaction();
    }

    public function prepare($query) {
        return $this->con->prepare($query);
    }

    public function escape_string($string) {
        return $this->con->real_escape_string($string);
    }
}
?>
