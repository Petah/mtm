<?php
/**
 * MTM\CLI\LowCommand
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\CLI;
use MTM\API\LowAPI;
use MTM\Model\LowModel;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LowCommand extends BaseCommand {

    /**
     * {@inheritdoc}
     */
    protected function configure() {
        parent::configure();
        $this->setName('low-update');
        $this->setDescription('Update saved low price searches.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $lowAPI = new LowAPI();
        foreach ($lowAPI->get() as $listing) {
            foreach (LowModel::iterateAll($this->dataStore) as $lowModel) {
                if ($lowModel->matchListing($listing)) {
                    $output->writeln('Found match: ' . $listing->title->s() . ' ' . $listing->priceDisplay->s());
                }
            }
        }
    }

}
