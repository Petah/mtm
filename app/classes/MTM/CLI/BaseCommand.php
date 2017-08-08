<?php
/**
 * MTM\CLI\LowCommand
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\CLI;
use Symfony\Component\Console\Command\Command;

class BaseCommand extends Command {

    protected $dataStore;

    public function __construct($dataStore) {
        parent::__construct();
        $this->dataStore = $dataStore;
    }

}
