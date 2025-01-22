<?php
require_once 'vendor/autoload.php';

use Facebook\Facebook;

session_start();

$fb = new Facebook([
    'app_id' => '3468496440119084',
    'app_secret' => '26e5fd221a141d844c3fef16667a2dc5',
    'default_graph_version' => 'v16.0', // Gunakan versi terbaru
]);

// URL login Facebook
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Izin yang diperlukan
$floginUrl = $helper->getLoginUrl('http://localhost/Tugas-Web-Gilang/Tugas%201%20-%205/fbcallback.php', $permissions);

// Konfigurasi Google OAuth
$client = new Google\Client();
$client->setClientId('536589307738-tm407j5uju6cvf0o0q2hi4k845v37d1b.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/Tugas-Web-Gilang/Tugas%201%20-%205/callback.php'); // Ubah dengan URL callback Anda
$client->addScope('email');
$client->addScope('profile');

// Redirect ke URL Google untuk login
$GloginUrl = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Sign Up Option</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="asset/insight.png" alt="VoluntApp Logo">
        </div>
        <div class="title2">VoluntApp</div>
        <a href="signup.html" class="button2 mail">
            <img src="asset/mail.png" alt="Email Icon">
            Sign Up with Email
        </a>
        <a href="<?= $floginUrl ?>" class="button2 facebook">
            <img src="asset/facebook.png" alt="Facebook Icon">
            Sign Up with Facebook
        </a>
        <a href="<?= $GloginUrl ?>" class="button2 google">
            <img src="asset/search.png" alt="Google Icon">
            Sign Up with Google
        </a>
        <footer>
            &copy; 2025 Muhammad Gilang Ramadhan. All rights reserved.
        </footer>
</body>
</html>
