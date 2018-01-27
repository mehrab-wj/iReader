<?php
class DatabaseConnection {
  public $host = "localhost";
  public $username = "root";
  public $password = "";
  public $dbname = "ireader";

  public $con;
  public $select_db;
  function __construct() {
    $this->con = mysqli_connect($this->host, $this->username, $this->password);
    if (!$this->con){
        die("Database Connection Failed :( <br>" . mysqli_error($this->con));
    }
    $this->select_db = mysqli_select_db($this->con, $this->dbname);
    if (!$this->select_db){
        die("Database Selection Failed :! <br>" . mysqli_error($this->con));
    }
    mysqli_query($this->con,"SET NAMES 'utf8mb4'");
    mysqli_query($this->con,"SET CHARACTER SET 'utf8mb4'");
    mysqli_query($this->con,"SET character_set_connection = 'utf8mb4'");
  }

}


 ?>
