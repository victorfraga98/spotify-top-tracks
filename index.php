<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Victor Fraga</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
    </head>
    <body class="center purple-background">
        <h1 color="green-title">Auth</h1>
        <button onclick="userAuthRequest();">Log in</button>
    </body>
    <script>
        const userAuthRequest = () => {
            let logInUri = 'https://accounts.spotify.com/authorize' +
                '?client_id=<?php getenv('client_id')?>' +
                '&response_type=code' +
                '&redirect_uri=http://localhost/spotify-top-tracks/callback' +
                '&scope=user-top-read playlist-modify-public playlist-modify-private';

            window.open(logInUri, '_self');
        }
    </script>
</html>

