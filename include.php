<?php
define('ROOT', __DIR__);

if (!is_file(ROOT . '/environment.php')) {
    die('Environment not setup.');
}

include ROOT . '/vendor/autoload.php';
require_once ROOT . '/environment.php';
require_once ROOT . '/app/functions/global.php';


$routes = [
    '/' => 'RootController::index',
    '/404' => 'RootController::notFound',

    '/property' => 'PropertyController::index',

    '/low' => 'LowController::index',

    '/watch' => 'WatchController::index',
];

$url = getRequestedURL();
$route = substr($url, strlen(rtrim(BASE_URL, '/'))) ?: '/';

if (isset($routes[$route])) {
    call_user_func('MTM\Action\\' . $routes[$route]);
} else {
    call_user_func($routes['/404']);
}