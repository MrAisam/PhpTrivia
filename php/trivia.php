<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "⚠️ Please login first to play the quiz.";
    header("Location: ../html/login.html");
    exit();
}

include 'db.php';

$sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 5"; 
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Play Quiz</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../php/header.php'; ?>

    <main class="quiz-container">
        <h2>Trivia Started🎉</h2>
        <form action="submit.php" method="POST">
            <?php
            $qno = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<p><b>Q$qno. ".$row['question']."</b></p>";
                foreach (['option1','option2','option3','option4'] as $opt) {
                    echo "<label><input type='radio' name='answer[".$row['id']."]' value='".$row[$opt]."' required> ".$row[$opt]."</label><br>";
                }
                $qno++;
                echo "<br>";
            }
            ?>
            <button type="submit">Submit Answers</button>
        </form>
    </main>

    <?php include '../html/footer.html'; ?>
</body>
</html>
