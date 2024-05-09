<?php
namespace App;
/**
 * Database class
 */
class Database {
    private $host = 'localhost';
    private $username = 'dhruv';
    private $password = 'Dhruv@123';
    private $database = 'score';
    public $conn;
    
    /**
     * constructor for connection
     */
    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
