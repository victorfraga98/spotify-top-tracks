<?php

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
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Victor Fraga</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
    </head>
    <body class="center purple-background">
        <h1 color="green-title">Auth - </h1>
        <button onclick="userAuthRequest();">Log in</button>
    </body>
    <script>
        const userAuthRequest = () => {
            let logInUri = '<?php echo $url ?>';

            window.open(logInUri, '_self');
        }
    </script>
</html>

