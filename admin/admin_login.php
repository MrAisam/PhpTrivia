<?php
session_start();

// Hardcoded login credentials
$admin_user = "admin";
$admin_pass = "admin123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>Invalid credentials</p>";
        echo "<p style='text-align:center;'><a href='admin_login.html'>Try Again</a></p>";
    }
}
?>
