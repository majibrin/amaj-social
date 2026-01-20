<?php
require_once "includes/config.php";

echo "<h1>Amaj Social - System Health Check</h1>";
echo "<hr>";

// 1. Check Database Connection
if ($conn) {
    echo "<p style='color:green;'>✅ Database Connection: SUCCESS</p>";
} else {
    echo "<p style='color:red;'>❌ Database Connection: FAILED</p>";
}

// 2. Check Class Autoloading
if (class_exists('User') && class_exists('Database') && class_exists('Post')) {
    echo "<p style='color:green;'>✅ OOP Class Autoloading: SUCCESS</p>";
} else {
    echo "<p style='color:red;'>❌ OOP Class Autoloading: FAILED (Check /classes folder)</p>";
}

// 3. Check Session Logic
if (isset($_SESSION)) {
    echo "<p style='color:green;'>✅ PHP Session Logic: ACTIVE</p>";
} else {
    echo "<p style='color:red;'>❌ PHP Session Logic: INACTIVE</p>";
}

// 4. Check Folder Permissions
$upload_dir = 'images/posts/';
if (is_writable($upload_dir)) {
    echo "<p style='color:green;'>✅ Image Upload Directory: WRITABLE</p>";
} else {
    echo "<p style='color:red;'>❌ Image Upload Directory: NOT WRITABLE (Run chmod 777 images/posts)</p>";
}

echo "<hr>";
echo "<a href='index.php'>Go to Login Page</a>";
?>
