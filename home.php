<?php
require_once "includes/config.php";
if(!isset($_SESSION['unique_id'])) header("location: index.php");

$posts = $postObj->getAllPosts();
include "includes/header.php";
?>
<div class="main-container">
    <div class="post-card">
        <form action="ajax/add_post.php" method="POST" enctype="multipart/form-data">
            <textarea name="post_msg" placeholder="What's on your mind, Study Assistant?" required></textarea>
            <input type="file" name="post_img" accept="image/*">
            <button type="submit" name="submit" class="btn-primary">Post</button>
        </form>
    </div>

    <div id="feed">
        <?php while($row = $posts->fetch_assoc()): ?>
            <div class="post-card" data-id="<?php echo $row['postid']; ?>">
                <div class="post-header">
                    <img src="images/profiles/<?php echo $row['image'] ?? 'default.png'; ?>" class="avatar">
                    <div class="user-info">
                        <strong><?php echo $row['fname'] . " " . $row['lname']; ?></strong>
                        <span><?php echo date('H:i', strtotime($row['created'])); ?></span>
                    </div>
                </div>
                <p class="post-text"><?php echo $row['post_msg']; ?></p>
                <?php if($row['post_img']): ?>
                    <img src="images/posts/<?php echo $row['post_img']; ?>" class="post-img">
                <?php endif; ?>
                <div class="post-footer">
                    <button class="like-btn" onclick="toggleLike(<?php echo $row['postid']; ?>)">
                        <i class="fas fa-heart"></i> <span class="count"><?php echo $row['likes']; ?></span>
                    </button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include "includes/footer.php"; ?>
