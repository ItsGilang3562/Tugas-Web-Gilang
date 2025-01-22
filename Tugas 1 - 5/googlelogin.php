<?php
require 'asset/vendor/autoload.php';

session_start();
$client = new Google\Client();

// Konfigurasi Google Client
$client_id = "751751551909-2dua34tunpohi4qkc2ig9hac1dspk2oc.apps.googleusercontent.com";
$client_secret = "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";
$redirect_uri = "http://localhost/SignUp/googlelogin.php";

// Inisialisasi Google Client
$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

// Tangani proses login
if (!isset($_GET['code'])) {
    // Redirect ke halaman login Google
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    exit();
} else {
    // Tukar kode otorisasi dengan token akses
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Ambil data pengguna
    $google_service = new Google\Service\Oauth2($client);
    $user_info = $google_service->userinfo->get();

    // Simpan data pengguna ke sesi
    $_SESSION['name'] = $userInfo->name;
    $_SESSION['email'] = $userInfo->email;
    $_SESSION['picture'] = $userInfo->picture;

    // Redirect ke halaman dashboard
    header('Location: profile.php');
    exit();
}