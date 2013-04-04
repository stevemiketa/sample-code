<?php
namespace Asciishop\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ShowCommand extends Command {

    protected function configure() {
        $this->setName('S')
            ->setDescription('Display the current image');
    }

    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $app = $this->getApplication();
        $grid = $app->getCanvas()->show();
        list($rootX, $rootY) = $app->getCanvas()->getOrigin();

        if ($grid) {
            $line_format = join(' ', array_fill($rootY, sizeof($grid[$rootX]), '%s'));

            $output->writeln("=>");
            foreach ($grid as $row=>$colData) {
                $output->writeln(vsprintf($line_format, $colData));
            }
        }
    }
}
