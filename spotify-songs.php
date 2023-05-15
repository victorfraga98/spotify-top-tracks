<?php

session_start();

$url = 'https://api.spotify.com/v1';
$endpoint = '/me/top/tracks?time_range=long_term&limit=50';
$token = $_SESSION['user_token'];


$options = ['http' => ['header' => 'Authorization: Bearer ' . $token,
                       'method' => 'GET']];
$context = stream_context_create($options);

$get_response = file_get_contents($url . $endpoint, false, $context);
$data_object = json_decode($get_response, true);

$top = [];

foreach ($data_object['items'] as $item) {
    $song_name = $item['name'];
    $song_artists = [];
    $song_album = $item['album']['images'][0]['url'];
    $song_album_link = $item['album']['external_urls']['spotify'];

    foreach($item['artists'] as $artist) {
        array_push($song_artists, $artist['name']);
    };

    $top[$song_name] = ['artists' => implode(", ", $song_artists),
                        'album' => $song_album,
                        'album_link' => $song_album_link];
}


?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Top tracks</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
    </head>
    <body class="purple-background">
        <h1 class="center green-title">Top tracks</h1>
        <ol class="list">
        <?php $i = 1; foreach ($top as $song => $song_info) : ?>
            <li>
                <span class="center song-order"><?="$i"?></span>
                <a class="song-album" target="_blank" href="<?=$song_info['album_link']?>"><img class="song-album-image" src="<?=$song_info['album']?>"></a>
                <div class="song-info">
                    <span class="song-title"><?=$song?></span><br>
                    <span class="song-artist"><?=$song_info['artists']?></span>
                </div>
            </li>
        <?php $i++; endforeach ?>
        </ol>
    </body>
</html>