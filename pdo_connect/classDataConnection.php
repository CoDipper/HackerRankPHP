<?php
/*
| -------------------------------------------------------------------------
| DATABASE CONNECTION CLASS
| PDO CONNECTION
| -------------------------------------------------------------------------
*/
Class Database {
  // database credentials
	private $host = "localhost";
	private $db_name = "itest";
	private $username = "ikaradzhov";
	private $password = "roK!39";
	public $conn = null;

  // get the database connection
  public function getConnection() {
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->conn->exec("SET NAMES UTF8");
    }
    catch(PDOException $exception) {
      echo "Connection error: " . $exception->getMessage();
    }
	
    return $this->conn;
  }

  // close connection
  public function closeConnection() {
    $this->conn = null;
  }
}

?>
