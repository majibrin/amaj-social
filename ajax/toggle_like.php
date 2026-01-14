<?php
require_once "../includes/config.php";
header('Content-Type: application/json');

if (isset($_POST['post_id']) && isset($_SESSION['unique_id'])) {
    $postObj = new Post($conn);
    $action = $postObj->toggleLike($_POST['post_id'], $_SESSION['unique_id']);
    
    // Get new count
    $res = $conn->query("SELECT likes FROM posts WHERE postid = " . (int)$_POST['post_id']);
    $row = $res->fetch_assoc();

    echo json_encode([
        'status' => 'success',
        'action' => $action,
        'likes' => $row['likes']
    ]);
}
