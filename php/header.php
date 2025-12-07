<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <div class="logo">🎯 Trivia Game</div>
    <nav>
        <a href="../html/index.html">Home</a>
        <a href="trivia.html">Play Trivia</a>
        <a href="../html/about.html">About</a>
        <?php if (isset($_SESSION['user'])): ?>
    <span class="welcome"><?= htmlspecialchars($_SESSION['user']); ?></span>
    <a href="../php/logout.php" class="logout">Logout</a>
<?php else: ?>
    <a href="../html/login.html">Login</a>
    <a href="../html/register.html">Register</a>
<?php endif; ?>

    </nav>
</header>
