<?php 
namespace Asciishop\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CreateCommand extends Command {

    protected function configure() {
        $this->setName('I')
            ->setDescription('Create a new image with the given dimensions (wxh)')
            ->addArgument(
                'columns',
                InputArgument::REQUIRED,
                'Width of the image'
            )
            ->addArgument(
                'rows',
                InputArgument::REQUIRED,
                'Height of the image'
            );
    }

    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $app = $this->getApplication();

        $cols = (int)$input->getArgument('columns');
        $rows = (int)$input->getArgument('rows');

        $app->getCanvas()->create($cols, $rows);
    }
}
