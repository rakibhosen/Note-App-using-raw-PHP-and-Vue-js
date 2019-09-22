<?php
class connection{
private $dbhost = "localhost";
private $dbuser = "root";
private $dbpass= "";
private $dbname ="vue";
public $db;

public function __construct(){
    $this->connectDB();
}

private function connectDB(){
    try {
        $this->db = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname}", $this->dbuser, $this->dbpass);
        // set the PDO error mode to exception
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
}





}





