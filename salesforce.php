<?php

function get_access_token()
{
    $tokenEndpoint = 'https://ruby-site-6762.my.salesforce.com/services/oauth2/token'; // Replace with the actual token endpoint URL
    $client_id = '3MVG9Xl3BC6VHB.ZPOdbVGMwfjDS63_fcdRhWsFlJeEAPiEFKEmKFMJRmdDxNJB5_jqyESh790zztNg6Mj.zG';
    $client_secret = '5F86F50BF581A8DAAA1C769B5E7FFFF69CDDD5C841D4EAEFA144BAB48ADADD00';
    $grant_type = 'client_credentials';

    $params = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => $grant_type
    ];

    $url = $tokenEndpoint . '?' . http_build_query($params);

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        // Handle the error accordingly
    }

    // Close cURL session
    curl_close($ch);

    // Decode the JSON response
    $tokenData = json_decode($response, true);

    // Extract the access token
    $accessToken = $tokenData['access_token'];

    return $accessToken;
}
