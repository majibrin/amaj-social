<?php
require_once "includes/config.php";
if(!isset($_SESSION['unique_id'])) header("location: index.php");

$them_id = mysqli_real_escape_string($conn, $_GET['unique_id']);
$stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
$stmt->bind_param("i", $them_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

include "includes/header.php";
?>
<div class="chat-wrapper">
    <header class="chat-header">
        <a href="messages.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="images/<?php echo $user['image']; ?>" class="avatar-sm">
        <div class="details">
            <span><?php echo $user['fname'] . " " . $user['lname']; ?></span>
            <p><?php echo $user['status']; ?></p>
        </div>
    </header>
    <div class="chat-box" id="chat-box">
        </div>
    <form action="#" class="typing-area">
        <input type="text" name="incoming_id" value="<?php echo $them_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
    </form>
</div>

<script src="assets/js/chat.js"></script>
<?php include "includes/footer.php"; ?>
