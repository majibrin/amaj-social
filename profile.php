<?php
require_once "includes/config.php";
if(!isset($_SESSION['unique_id'])) header("location: index.php");

$uid = $_SESSION['unique_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$me = $stmt->get_result()->fetch_assoc();

include "includes/header.php";
?>
<div class="profile-header">
    <img src="images/<?php echo $me['image']; ?>" class="profile-avatar">
    <h2><?php echo $me['fname'] . " " . $me['lname']; ?></h2>
    <p><?php echo $me['email']; ?></p>
    <a href="change_password.php" class="btn-sm">Change Password</a>
</div>
<div class="my-posts">
    </div>
<?php include "includes/footer.php"; ?>
