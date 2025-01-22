<?php
require_once 'asset/vendor/autoload.php';

session_start();

// Konfigurasi Google OAuth
$client = new Google\Client();
$client->setClientId('751751551909-2dua34tunpohi4qkc2ig9hac1dspk2oc.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/SignUp/callback.php'); // Ubah dengan URL callback Anda

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Ambil informasi pengguna
    $oauth = new Google\Service\Oauth2($client);
    $userInfo = $oauth->userinfo->get();
    $peopleService = new Google\Service\PeopleService($client);
    $profile = $peopleService->people->get('people/me', ['personFields' => 'names,emailAddresses,photos']);

    $_SESSION['name'] = $profile->getNames()[0]->getDisplayName();
    $_SESSION['email'] = $profile->getEmailAddresses()[0]->getValue();
    $_SESSION['picture'] = $profile->getPhotos()[0]->getUrl();

    header('Location: profile.php'); // Redirect ke halaman profil
    exit();
} else {
    echo "Error: Tidak dapat mendapatkan kode autentikasi.";
}
