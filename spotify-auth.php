<?php

if($_POST['number-songs']) {
    session_start();
    $_SESSION['number-songs'] = $_POST['number-songs'];
    $_SESSION['period'] = $_POST['period'];

    require_once realpath(__DIR__ . "/vendor/autoload.php");

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $client_id = $_ENV['CLIENT_ID'];
    $redirect_uri = 'http://localhost/spotify-top-tracks/callback';
    $scope = urlencode('user-top-read playlist-modify-public playlist-modify-private');

    $url = "https://accounts.spotify.com/authorize" . 
            "?client_id=" . $client_id . 
            "&response_type=code" . 
            "&redirect_uri=" . urlencode($redirect_uri) .
            "&scope=" . $scope;

    // Redirect the user to the Spotify login page
    header('Location: ' . $url);
    exit;
} else {
    echo "Oh! Something went wrong.";
}

?>