<?php 
namespace Asciishop\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ColorCommand extends Command {

    protected function configure() {
        $this->setName('L')
            ->setDescription('Color a pixel located at (x,y)')
            ->addArgument(
                'x',
                InputArgument::REQUIRED,
                'X position of the pixel'
            )
            ->addArgument(
                'y',
                InputArgument::REQUIRED,
                'Y position of the pixel'
            )
            ->addArgument(
                'color',
                InputArgument::REQUIRED,
                'Color to use filling this pixel'
            );
    }

    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $app = $this->getApplication();
        $app->getCanvas()->color(
            intval($input->getArgument('x')),
            intval($input->getArgument('y')),
            $input->getArgument('color')
        );
    }
}
