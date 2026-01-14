<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'sql111.infinityfree.com';
    private $user = 'if0_39438117';
    private $pass = 'YOUR_PASSWORD_HERE'; 
    private $db   = 'if0_39438117_amaj';

    private function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
