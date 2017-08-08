<?php
require_once __DIR__ . '/include.php';

$routes = [
    '/' => 'MTM\Action\RootController::index',
    '/404' => 'MTM\Action\RootController::notFound',

    '/property' => 'MTM\Action\PropertyController::index',
    '/property/icon' => 'MTM\Action\PropertyController::icon',

    '/low' => 'MTM\Action\LowController::index',
    '/low/save' => 'MTM\Action\LowController::save',

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
    $controller->setDataStore($dataStore);
    $controller->setRequest($request);
    $controller->$method();
} else {
    $controller = new MTM\Action\RootController();
    $controller->setRequest($request);
    $controller->notFound();
}
