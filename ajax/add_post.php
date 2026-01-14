<?php
require_once "../includes/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['unique_id'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die(json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']));
    }

    $msg = mysqli_real_escape_string($conn, $_POST['post-msg']);
    $uid = $_SESSION['unique_id'];
    $img_name = "";

    if (isset($_FILES['post-img']) && $_FILES['post-img']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['post-img']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $img_name = "post_" . time() . "_" . rand(1000, 9999) . "." . $ext;
            move_uploaded_file($_FILES['post-img']['tmp_name'], "../images/" . $img_name);
        }
    }

    $postObj = new Post($conn);
    if ($postObj->create($uid, $msg, $img_name)) {
        header("Location: ../home.php");
    } else {
        echo "Error creating post.";
    }
}
