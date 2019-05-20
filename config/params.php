<?php

$paramsLocalPath = __DIR__ . '/params-local.php';;
$paramsLocal = file_exists($paramsLocalPath) ? include $paramsLocalPath : array();

$params = [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
];

return !empty($paramsLocal) ? array_merge($params, $paramsLocal) : $params;
