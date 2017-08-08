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

$errorHandler = new XMod\Debug\Error\Handler();
$debugHandler = new XMod\Debug\Error\Handler\Debug();
$errorHandler->addErrorHandler([$debugHandler, 'handleError']);
$errorHandler->addFatalErrorHandler([$debugHandler, 'handleFatalError']);
$errorHandler->addExceptionHandler([$debugHandler, 'handleException']);
$errorHandler->register();

$dataStore = new MTM\DataStore\SerializedFile();
$dataStore->setFile(ROOT . '/data/data-store.ser');
$dataStore->open();

register_shutdown_function([$dataStore, 'close']);
