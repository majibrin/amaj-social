<?php
session_start();
spl_autoload_register(function ($class) {
    include_once __DIR__ . '/../classes/' . $class . '.php';
});

$database = Database::getInstance();
$conn = $database->getConnection();
$userObj = new User($conn);

// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

define('IMG_PATH', 'assets/images/');
