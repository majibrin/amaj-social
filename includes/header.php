<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amaj Social</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script>
        const USER_ID = <?php echo $_SESSION['unique_id'] ?? 'null'; ?>;
    </script>
</head>
<body>
<?php if(isset($_SESSION['unique_id'])): ?>
<nav class="nav-container">
    <div class="nav-menu">
        <a href="home.php" class="nav-link"><i class="fas fa-home"></i>Home</a>
        <a href="messages.php" class="nav-link"><i class="fas fa-comment"></i>Chat</a>
        <a href="profile.php" class="nav-link"><i class="fas fa-user"></i>Profile</a>
        <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Exit</a>
    </div>
</nav>
<?php endif; ?>
