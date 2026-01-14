<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Environment Detection
        $is_local = (
            $_SERVER['HTTP_HOST'] === 'localhost' || 
            $_SERVER['HTTP_HOST'] === '127.0.0.1'
        );

        if ($is_local) {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db   = "amaj"; 
        } else {
            $host = "sql111.infinityfree.com";
            $user = "if0_39438117";
            $pass = "ImTVy0CWFG";
            $db   = "if0_39438117_amaj";
        }

        $this->conn = new mysqli($host, $user, $pass, $db);

        if ($this->conn->connect_error) {
            die("Database Connection Failed: " . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8mb4");
        date_default_timezone_set('Africa/Lagos');
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
