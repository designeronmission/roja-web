<?php
header('Content-Type: application/json');

$secretKey = "6Ldj4T4sAAAAABT6xOhY6pNuXU9kFQbf9GZjtZB4";
$token = $_POST['recaptcha_token'] ?? '';

if (!$token) {
    echo json_encode([
        'success' => false,
        'error' => 'Token missing'
    ]);
    exit;
}

$verifyURL = "https://www.google.com/recaptcha/api/siteverify";

$data = [
    'secret' => $secretKey,
    'response' => $token,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($data)
    ]
];

$response = json_decode(
    file_get_contents($verifyURL, false, stream_context_create($options)),
    true
);

/* 🔍 TEST OUTPUT */
echo json_encode([
    'success'  => $response['success'] ?? false,
    'score'    => $response['score'] ?? null,
    'action'   => $response['action'] ?? null,
    'hostname' => $response['hostname'] ?? null,
    'time'     => $response['challenge_ts'] ?? null
], JSON_PRETTY_PRINT);
