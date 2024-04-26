<?php
class Database {
    private $host = 'localhost';
    private $username = 'dhruv';
    private $password = 'Dhruv@123';
    private $database = 'score';
    public $conn;

    // Database connection
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Close connection
    public function closeConnection() {
        $this->conn->close();
    }
}
