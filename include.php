<?php
define('ROOT', __DIR__);

if (!is_file(ROOT . '/environment.php')) {
    die('Environment not setup.');
}

include ROOT . '/vendor/autoload.php';
require_once ROOT . '/environment.php';
require_once ROOT . '/app/functions/global.php';

(new Whoops\Run())->pushHandler(new Whoops\Handler\PrettyPageHandler())->register();

$routes = [
    '/' => 'MTM\Action\RootController::index',
    '/404' => 'MTM\Action\RootController::notFound',

    '/property' => 'MTM\Action\PropertyController::index',
    '/property/icon' => 'MTM\Action\PropertyController::icon',

    '/low' => 'MTM\Action\LowController::index',

    '/watch' => 'MTM\Action\WatchController::index',
];

$url = getRequestedURL();

$request = new MTM\Request();
$request->setURL($url);
$request->setInput($_REQUEST);

$route = substr(parse_url($url)['path'], strlen(rtrim(BASE_PATH, '/'))) ?: '/';

if (isset($routes[$route])) {
    list($class, $method) = explode('::', $routes[$route]);
    $controller = new $class();
    $controller->setRequest($request);
    $controller->$method();
} else {
    MTM\Action\RootController::notFound();
}