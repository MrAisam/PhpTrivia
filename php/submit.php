<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "⚠️ Please login first to play the quiz.";
    header("Location: ../html/login.html");
    exit();
}

include 'db.php';

$score = 0;
$total = 0;

if (isset($_POST['answer'])) {
    foreach ($_POST['answer'] as $qid => $ans) {
        $sql = "SELECT correct_answer FROM questions WHERE id=$qid";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['correct_answer'] === $ans) {
                $score++;
            }
            $total++;
        }
    }
}

// ✅ Save score to database
if ($total > 0) {
    $username = $_SESSION['user'];

    // Insert or update score
    $stmt = $conn->prepare("
        INSERT INTO scores (username, score) 
        VALUES (?, ?) 
        ON DUPLICATE KEY UPDATE score = VALUES(score)
    ");
    $stmt->bind_param("si", $username, $score);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Results</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Quiz Results 🎯</h2>
    <?php if ($total > 0): ?>
        <p>You scored <b><?php echo $score; ?></b> out of <b><?php echo $total; ?></b></p>
    <?php else: ?>
        <p>No answers submitted!</p>
    <?php endif; ?>

    <a href="../html/trivia.html"><button>Play Again</button></a>
    <a href="../html/index.html"><button>Back to Home</button></a>
</body>
</html>
