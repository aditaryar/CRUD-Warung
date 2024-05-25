<?php
class Database {
    private $con;
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db = "warung";

    function __construct() {
        $this->start_con();
    }

    function start_con() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->con->connect_error) {
            die('Can not connect mysql server local: ' . $this->con->connect_error);
        }
    }

    function close_con() {
        return $this->con->close();
    }

    function sqlquery($sql) {
        return $this->con->query($sql);
    }

    function jumrec($sql) {
        if ($hasil = $this->sqlquery($sql))
            $jum = $hasil->num_rows;
        else    
            $jum = 0;
        return $jum;
    }

    function datasql($sql) {
        $data = array();
        if ($hasil = $this->sqlquery($sql))
            $data = $hasil->fetch_array(MYSQLI_BOTH);
        return $data;
    }

    function fetchdata($sql) {
        $res = array();
        if ($hasil = $this->sqlquery($sql))
            while ($data = $hasil->fetch_array(MYSQLI_BOTH)) {
                $res[] = $data;
            }
        return $res;
    }

    function get_error() {
        return $this->con->error;
    }

    public function beginTransaction() {
        mysqli_autocommit($this->con, FALSE);
      }
    
      public function rollbackTransaction() {
        mysqli_rollback($this->con);
      }
    
      public function insert_id() {
        return mysqli_insert_id($this->con);
    
      }
    
      public function commitTransaction() {
        mysqli_commit($this->con);
      }

      public function begin_transaction() {
        $this->con->begin_transaction();
    }
}
?>
