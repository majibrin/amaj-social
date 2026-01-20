<?php
require_once "../includes/config.php";
if(!isset($_SESSION['unique_id'])) exit();

$chatObj = new Chat($conn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // SENDING MESSAGE
    $sender = $_SESSION['unique_id'];
    $receiver = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($message)) {
        $chatObj->sendMessage($sender, $receiver, $message);
    }
} else {
    // GETTING MESSAGES
    $me = $_SESSION['unique_id'];
    $them = mysqli_real_escape_string($conn, $_GET['them']);
    $output = "";

    $query = $chatObj->getMessages($me, $them);
    if($query->num_rows > 0) {
        while($row = $query->fetch_assoc()) {
            if($row['outgoing_id'] === $me) {
                $output .= '<div class="message outgoing">
                                <p>'. $row['message'] .'</p>
                            </div>';
            } else {
                $output .= '<div class="message incoming">
                                <p>'. $row['message'] .'</p>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
}
