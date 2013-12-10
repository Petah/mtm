<?php
define('ROOT', __DIR__);

if (!is_file(ROOT . '/environment.php')) {
    die('Environment not setup.');
}

date_default_timezone_set('Pacific/Auckland');

include ROOT . '/vendor/autoload.php';
require_once ROOT . '/environment.php';
require_once ROOT . '/app/functions/global.php';
require_once ROOT . '/app/functions/score.php';

//(new Whoops\Run())->pushHandler(new Whoops\Handler\PrettyPageHandler())->register();
$errorHandler = new XMod\Debug\Error\Handler();
$debugHandler = new XMod\Debug\Error\Handler\Debug();
$errorHandler->addErrorHandler([$debugHandler, 'handleError']);
$errorHandler->addFatalErrorHandler([$debugHandler, 'handleFatalError']);
$errorHandler->addExceptionHandler([$debugHandler, 'handleException']);
$errorHandler->register();

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
    $controller = new MTM\Action\RootController();
    $controller->setRequest($request);
    $controller->notFound();
}