<?php

function callAPI($method, $url, $headers, $body)
{
    $curl = curl_init();

    if ($method === 'POST') {
        curl_setopt($curl, CURLOPT_POST, true);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}