<?php
namespace Asciishop\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ClearCommand extends Command {
    
    protected function configure() {
        $this->setName('C')
            ->setDescription('Clear the current image');
    }

    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $app = $this->getApplication();
        $app->getCanvas()->clear();
    }
}
