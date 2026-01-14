<?php
require_once "includes/config.php";
if(isset($_SESSION['unique_id'])) {
    $userObj->setStatus($_SESSION['unique_id'], "Offline");
    session_unset();
    session_destroy();
}
header("location: index.php");
