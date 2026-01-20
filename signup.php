<?php
require_once "includes/config.php";
if(isset($_SESSION['unique_id'])) header("location: home.php");

$error = "";
if(isset($_POST['signup'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];
    
    // Default image for all new signups
    $img_name = "default.png";

    $uid = $userObj->signup($fname, $lname, $email, $phone, $password, $img_name);
    
    if($uid) {
        $_SESSION['unique_id'] = $uid;
        header("location: home.php");
    } else {
        $error = "Email already exists or registration failed.";
    }
}
include "includes/header.php";
?>
<div class="auth-container">
    <form action="" method="POST" class="auth-form">
        <h2>Join Amaj</h2>
        <?php if($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="text" name="lname" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="phone" placeholder="Phone Number">
        <input type="password" name="password" placeholder="Create Password" required>
        <button type="submit" name="signup" class="btn-primary">Create Account</button>
        <p>Already a member? <a href="index.php">Login</a></p>
    </form>
</div>
<?php include "includes/footer.php"; ?>
