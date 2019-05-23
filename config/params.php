<?php

$paramsLocalPath = __DIR__ . '/params-local.php';;
$paramsLocal = file_exists($paramsLocalPath) ? include $paramsLocalPath : array();

$params = [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'google_maps_js_api_key' => '', // For Google maps to work correctly, specify your api key in params-local.php
];

return !empty($paramsLocal) ? array_merge($params, $paramsLocal) : $params;
