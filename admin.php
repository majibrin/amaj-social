<?php
require_once "includes/config.php";
// Simple admin check - you can expand this later
if(!isset($_SESSION['unique_id'])) header("location: index.php");

$stmt = $conn->query("SELECT * FROM users ORDER BY fname ASC");

include "includes/header.php";
?>
<div class="main-content">
    <div class="post-card">
        <h3>Admin Dashboard - User Management</h3>
        <table style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="border-bottom: 2px solid var(--emerald);">
                    <th style="text-align:left; padding:10px;">User</th>
                    <th style="text-align:left; padding:10px;">Status</th>
                    <th style="text-align:left; padding:10px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = $stmt->fetch_assoc()): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding:10px;"><?php echo $user['fname'] . " " . $user['lname']; ?></td>
                    <td style="padding:10px;"><?php echo $user['status']; ?></td>
                    <td style="padding:10px;"><a href="profile.php?id=<?php echo $user['unique_id']; ?>">View</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include "includes/footer.php"; ?>
