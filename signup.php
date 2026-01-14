<?php
require_once "includes/config.php";
if(isset($_SESSION['unique_id'])) header("location: home.php");

if(isset($_POST['signup'])) {
    $img_name = "default.png";
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $img_name = "profile_".time().".". $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "images/".$img_name);
    }
    
    $res = $userObj->signup($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['password'], $img_name);
    if($res) {
        $_SESSION['unique_id'] = $res;
        header("location: home.php");
    }
}
include "includes/header.php";
?>
<div class="auth-container">
    <form action="" method="POST" enctype="multipart/form-data" class="auth-form">
        <h2>Join Amaj</h2>
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="text" name="lname" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="number" name="phone" placeholder="Phone">
        <input type="password" name="password" placeholder="Password" required>
        <label>Profile Image</label>
        <input type="file" name="image">
        <button type="submit" name="signup" class="btn-primary">Sign Up</button>
    </form>
</div>
<?php include "includes/footer.php"; ?>
