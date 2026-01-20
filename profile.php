<?php
require_once "includes/config.php";
if(!isset($_SESSION['unique_id'])) header("location: index.php");

$userId = $_GET['id'] ?? $_SESSION['unique_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$myPosts = $postObj->getUserPosts($userId);

include "includes/header.php";
?>
<div class="profile-container">
    <div class="profile-header post-card">
        <img src="images/profiles/<?php echo $user['image']; ?>" class="profile-lg-avatar">
        <h2><?php echo $user['fname'] . " " . $user['lname']; ?></h2>
        <p class="status"><?php echo $user['status']; ?></p>
        <?php if($userId == $_SESSION['unique_id']): ?>
            <a href="change_password.php" class="btn-sm">Settings</a>
        <?php endif; ?>
    </div>

    <div class="user-posts">
        <h3>Posts by <?php echo $user['fname']; ?></h3>
        <?php while($row = $myPosts->fetch_assoc()): ?>
            <div class="post-card">
                <p><?php echo $row['post_msg']; ?></p>
                <?php if($row['post_img']): ?>
                    <img src="images/posts/<?php echo $row['post_img']; ?>" class="post-img">
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include "includes/footer.php"; ?>
