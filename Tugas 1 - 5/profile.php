<?php
session_start();

if (!isset($_SESSION['name'])) {
    header('Location: option.php'); // Jika belum login, redirect ke halaman login
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestApp-Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="asset/insight.png" alt="VoluntApp Logo">
        </div>
        <div class="title">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></div>
        <div class="subtitle"><?= htmlspecialchars($_SESSION['email']) ?></div>
        <a href="logout.php" class="buttonout">Logout</a>
    </div>

    <footer>
        &copy; 2025 Muhammad Gilang Ramadhan. All rights reserved.
    </footer>
</body>
</html>