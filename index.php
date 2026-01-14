<?php
require_once "includes/config.php";
if(isset($_SESSION['unique_id'])) header("location: home.php");

$error = "";
if(isset($_POST['login'])) {
    $user = $userObj->login($_POST['email'], $_POST['password']);
    if($user) {
        $_SESSION['unique_id'] = $user['unique_id'];
        $userObj->setStatus($user['unique_id'], "Online");
        header("location: home.php");
    } else {
        $error = "Invalid email or password!";
    }
}
include "includes/header.php";
?>
<div class="auth-container">
    <form action="" method="POST" class="auth-form">
        <h2>Amaj Login</h2>
        <?php if($error): ?><p class="error"> <?php echo $error; ?> </p><?php endif; ?>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login" class="btn-primary">Login</button>
        <p>Don't have an account? <a href="signup.php">Signup now</a></p>
    </form>
</div>
<?php include "includes/footer.php"; ?>
