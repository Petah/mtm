<?php
/**
 * CLI
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
use Symfony\Component\Console\Application;

require_once __DIR__ . '/include.php';

$application = new Application();
$application->addCommands([
    new MTM\CLI\LowCommand($dataStore),
]);
$application->run();
