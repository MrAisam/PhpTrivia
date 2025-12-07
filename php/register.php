<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!preg_match("/^[A-Za-z ]+$/", $username)) {
        echo "Error : Username can NOT have numbers! 
              <a href='../html/register.html'>Try again</a>";
        exit();
    }

    $today = date("Y-m-d");

    if ($dob > $today) {
        echo " Date of Birth cannot be a future date! 
              <a href='../html/register.html'>Try again</a>";
        exit();
    }

    $age = date_diff(date_create($dob), date_create($today))->y;

    if ($age < 5) {
        echo " You must be at least 5 years old to register! 
              <a href='../html/register.html'>Try again</a>";
        exit();
    }

    if (strlen($password) < 8) {
        echo " Password must be at least 8 characters long! 
              <a href='../html/register.html'>Try again</a>";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match! 
              <a href='../html/register.html'>Try again</a>";
        exit();
    }

    $check = "SELECT * FROM users WHERE username='$username'";
    $check_result = $conn->query($check);

    if ($check_result->num_rows > 0) {
        echo "Username already exists! 
              <a href='../html/register.html'>Try again</a>";
        exit();
    }

    $sql = "INSERT INTO users (username, email, dob, gender, password) 
            VALUES ('$username', '$email', '$dob', '$gender', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! 
              <a href='../html/login.html'>Login here</a>";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>
