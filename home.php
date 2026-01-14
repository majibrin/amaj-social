<?php
require_once "includes/config.php";
if(!isset($_SESSION['unique_id'])) header("location: index.php");

$postObj = new Post($conn);
$posts = $postObj->getFeed();

include "includes/header.php";
?>
<main class="main-content">
    <div class="stories-wrapper">
        <div class="stories" id="story-container">
            </div>
    </div>

    <div class="create-post-card">
        <form action="ajax/add_post.php" method="POST" enctype="multipart/form-data" id="post-form">
            <textarea name="post-msg" placeholder="What is on your mind?" required></textarea>
            <div class="post-actions">
                <label for="post-img"><i class="fas fa-camera"></i> Photo</label>
                <input type="file" name="post-img" id="post-img" hidden>
                <button type="submit" class="btn-primary">Post</button>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        </form>
    </div>

    <div id="feed-container">
        <?php while($row = $posts->fetch_assoc()): ?>
            <div class="post-card" data-id="<?php echo $row['postid']; ?>">
                <div class="post-header">
                    <img src="images/<?php echo $row['user_img']; ?>" class="avatar">
                    <div class="post-meta">
                        <span class="username"><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></span>
                        <span class="time"><?php echo date('j M, g:i a', strtotime($row['created'])); ?></span>
                    </div>
                </div>
                <div class="post-body">
                    <p><?php echo nl2br(htmlspecialchars($row['post_msg'])); ?></p>
                    <?php if($row['post_img']): ?>
                        <img src="images/<?php echo $row['post_img']; ?>" class="post-img">
                    <?php endif; ?>
                </div>
                <div class="post-footer">
                    <button class="like-btn <?php /* check like status logic */ ?>" onclick="toggleLike(<?php echo $row['postid']; ?>)">
                        <i class="fas fa-thumbs-up"></i> <span class="count"><?php echo $row['likes']; ?></span>
                    </button>
                    <button class="comment-trigger"><i class="fas fa-comment"></i> Comment</button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main>
<?php include "includes/footer.php"; ?>
