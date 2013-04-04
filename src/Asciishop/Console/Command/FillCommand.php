<?php 
namespace Asciishop\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class FillCommand extends Command {

    protected function configure() {
        $this->setName('F')
            ->setDescription('Fill an area of the canvas')
            ->addArgument(
                'x',
                InputArgument::REQUIRED,
                'X position'
            )
            ->addArgument(
                'y',
                InputArgument::REQUIRED,
                'Y position'
            )
            ->addArgument(
                'color',
                InputArgument::REQUIRED,
                'Color to use filling this line'
            );
    }

    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $app = $this->getApplication();
        $app->getCanvas()->fill(
            intval($input->getArgument('x')),
            intval($input->getArgument('y')),
            $input->getArgument('color')
        );
    }
}
