<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) {
            $_SESSION['user'] = $username;
            header("Location: ../html/index.html");
            exit();
        } else {
            header("Location: ../html/login.html?msg=" . urlencode("❌ Invalid password!"));
            exit();
        }
    } else {
        header("Location: ../html/login.html?msg=" . urlencode("❌ User not found!"));
        exit();
    }
}
?>
