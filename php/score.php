<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $score = intval($_POST['score']); // score from form/JS

    // Insert or update score
    $sql = "INSERT INTO scores (username, score) 
            VALUES ('$username', $score)
            ON DUPLICATE KEY UPDATE score = $score";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Score updated successfully!";
    } else {
        echo "❌ Error: " . $conn->error;
    }
} else {
    echo "⚠️ Not logged in or invalid request.";
}
?>
