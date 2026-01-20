<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amaj Social</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo time(); ?>">
    
    <script>
        // Ensure USER_ID is always a valid JS value (number or null)
        const USER_ID = <?php echo isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : 'null'; ?>;
    </script>
</head>
<body>

<?php if(isset($_SESSION['unique_id'])): ?>
<nav class="nav-container">
    <div class="nav-menu">
        <a href="home.php" class="nav-link">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="messages.php" class="nav-link">
            <i class="fas fa-comment"></i>
            <span>Chat</span>
            <span id="notif-badge" class="badge" style="display:none;">0</span>
        </a>
        <a href="profile.php" class="nav-link">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
        <a href="logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <span>Exit</span>
        </a>
    </div>
</nav>
<?php endif; ?>
