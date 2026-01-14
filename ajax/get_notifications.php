<?php
require_once "../includes/config.php";
header('Content-Type: application/json');

if (isset($_SESSION['unique_id'])) {
    $uid = $_SESSION['unique_id'];
    // Count unread notifications
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM notifications WHERE receiver_id = ? AND is_read = 0");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    echo json_encode(['status' => 'success', 'count' => $res['count']]);
} else {
    echo json_encode(['status' => 'error', 'count' => 0]);
}
