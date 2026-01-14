<?php
require_once "includes/config.php";
if(!isset($_SESSION['unique_id'])) header("location: index.php");

$stmt = $conn->prepare("SELECT * FROM users WHERE unique_id != ?");
$stmt->bind_param("i", $_SESSION['unique_id']);
$stmt->execute();
$users = $stmt->get_result();

include "includes/header.php";
?>
<div class="users-list-container">
    <div class="search-bar">
        <input type="text" placeholder="Search users...">
    </div>
    <div class="users-list">
        <?php while($row = $users->fetch_assoc()): ?>
            <a href="chat.php?unique_id=<?php echo $row['unique_id']; ?>" class="user-item">
                <img src="images/<?php echo $row['image']; ?>" class="avatar">
                <div class="user-info">
                    <span><?php echo $row['fname'] . " " . $row['lname']; ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
                <div class="status-dot <?php echo strtolower($row['status']); ?>"></div>
            </a>
        <?php endwhile; ?>
    </div>
</div>
<?php include "includes/footer.php"; ?>
