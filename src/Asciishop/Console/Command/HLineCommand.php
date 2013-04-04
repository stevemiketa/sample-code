<?php 
namespace Asciishop\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class HLineCommand extends Command {

    protected function configure() {
        $this->setName('H')
            ->setDescription('Draw a horizontal line')
            ->addArgument(
                'x1',
                InputArgument::REQUIRED,
                'X1 position of the line'
            )
            ->addArgument(
                'x2',
                InputArgument::REQUIRED,
                'X2 position of the line'
            )
            ->addArgument(
                'y',
                InputArgument::REQUIRED,
                'Y position of the line'
            )
            ->addArgument(
                'color',
                InputArgument::REQUIRED,
                'Color to use filling this line'
            );
    }

    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $app = $this->getApplication();
        $app->getCanvas()->drawLine(
            intval($input->getArgument('x1')),
            intval($input->getArgument('x2')),
            intval($input->getArgument('y')),
            null,
            $input->getArgument('color')
        );

    }
}
