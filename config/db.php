<?php

$dbLocalPath = __DIR__ . '/db-local.php';
$dbLocal = file_exists($dbLocalPath) ? include $dbLocalPath : array();

$db = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=test-case-greenice',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

return !empty($dbLocal) ?  array_merge($db, $dbLocal) : $db;
