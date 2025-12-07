<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}

include "../php/db.php";

// Handle Add
if (isset($_POST['add'])) {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct = $_POST['correct_answer'];

    $sql = "INSERT INTO questions (question, option1, option2, option3, option4, correct_answer)
            VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correct')";
    $conn->query($sql);
    header("Location: manage_questions.html");
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM questions WHERE id=$id";
    $conn->query($sql);
    header("Location: manage_questions.html");
    exit();
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct = $_POST['correct_answer'];

    $sql = "UPDATE questions 
            SET question='$question', option1='$option1', option2='$option2', 
                option3='$option3', option4='$option4', correct_answer='$correct' 
            WHERE id=$id";
    $conn->query($sql);
    header("Location: manage_questions.html");
    exit();
}

// Fetch all questions
$result = $conn->query("SELECT * FROM questions");
$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

if (isset($_GET['fetch'])) {
    header("Content-Type: application/json");
    echo json_encode($questions);
    exit();
}
?>
