<?php

require_once './vendor/autoload.php';

$uri = $_SERVER["REQUEST_URI"];
preg_match('/^(.*index\.php)(.*?)(\?|$)/m', $uri, $matches);
$uri = $matches[2] ?? '';
$_GET['____route____'] = $uri;

if ($uri === '' || $uri === '/') {
    header("Location: /index.php/home");
    exit;
}

define('BP', __DIR__);

$mysqlCreds = [
    'MYSQL_PASSWORD' => 'root',
    'MYSQL_USER' => 'root',
    'MYSQL_DB' => 'trainee',
    'MYSQL_HOST' => 'mysql'
];

foreach ($mysqlCreds as $key => $value) {
    define($key, $value);
}

$core = new \Amasty\Trainee\Core();
$core->run();
