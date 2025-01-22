<?php
require_once 'asset/vendor/autoload.php';

use Facebook\Facebook;

session_start();

// Konfigurasi Facebook App
$fb = new Facebook([
    'app_id' => '962645189135567',
    'app_secret' => '9014d705ea93331522e80ff3d67b17bc',
    'default_graph_version' => 'v16.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
    if (!isset($accessToken)) {
        echo "Error: " . $helper->getError();
        exit();
    }

    // Atur access token
    $oAuth2Client = $fb->getOAuth2Client();
    $longLivedToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    $fb->setDefaultAccessToken($longLivedToken);

    // Ambil data pengguna
    $response = $fb->get('/me?fields=id,name,email,picture');
    $user = $response->getGraphUser();

    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['picture'] = $user['picture']['url'];

    header('Location: profile.php'); // Redirect ke halaman profil
    exit();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit();
}
?>
