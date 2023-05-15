<?php

require "../api_requests.php";
session_start();

$client_id = getenv('client_id');
$client_secret = getenv('client_secret');
$auth_token = base64_encode("$client_id:$client_secret");

$code = $_GET['code'];

$redirect_uri = 'http://localhost/spotify-top-tracks/callback';

$headers = [
    'Authorization: Basic ' . $auth_token,
    'Content-type: application/x-www-form-urlencoded'
];
$body = "grant_type=authorization_code&code=$code&redirect_uri=$redirect_uri";
            

$get_token = callAPI('POST', 'https://accounts.spotify.com/api/token', $headers, $body);
$response = json_decode($get_token, true);
$user_token = $response['access_token'];

$_SESSION['user_token'] = $user_token;
echo $user_token;
header("Location: ../spotify-songs.php");
?>