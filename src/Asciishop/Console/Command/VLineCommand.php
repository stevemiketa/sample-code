<?php 
namespace Asciishop\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class VLineCommand extends Command {

    protected function configure() {
        $this->setName('V')
            ->setDescription('Draw a vertical line')
            ->addArgument(
                'x',
                InputArgument::REQUIRED,
                'X position of the pixel'
            )
            ->addArgument(
                'y1',
                InputArgument::REQUIRED,
                'Y1 position of the line'
            )
            ->addArgument(
                'y2',
                InputArgument::REQUIRED,
                'Y2 position of the line'
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
            intval($input->getArgument('x')),
            null,
            intval($input->getArgument('y1')),
            intval($input->getArgument('y2')),
            $input->getArgument('color')
        );

    }
}
