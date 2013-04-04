<?php
namespace Asciishop\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ExitCommand extends Command {

    protected function configure() {
        $this->setName('X')
            ->setDescription('Terminate this session');
    }

    
    protected function execute(InputInterface $input, OutputInterface $output) {
        exit();
    }
}
