<?php
namespace Asciishop;

use Symfony\Component\Console\Application;

use Asciishop\Console\Command\ClearCommand;
use Asciishop\Console\Command\ColorCommand;
use Asciishop\Console\Command\CreateCommand;
use Asciishop\Console\Command\ExitCommand;
use Asciishop\Console\Command\FillCommand;
use Asciishop\Console\Command\HLineCommand;
use Asciishop\Console\Command\VLineCommand;
use Asciishop\Console\Command\ShowCommand;

/**
 * AsciiPhoto editor application
 *
 * Allows user to create AsciiArt images with the following functions
 *  - Color pixel
 *  - Draw line horizonally / vertically
 *  - Fill an area with a given color
 *  - Clear an image
 *  - Create an imagea
 *  - Display an image
 */
class Asciishop extends Application {

    private $canvas;

    /**
     *
     */
    public function __construct(ICanvas $canvas) {
        parent::__construct('Asciishop', '1.0');
        $this->canvas = $canvas;
    }

    /**
     * Initialize the application with the appropriate commands
     */
    public function init() {
        $this->addCommands(array(
            new ClearCommand(),
            new ColorCommand(),
            new CreateCommand(),
            new ExitCommand(),
            new FillCommand(),
            new HLineCommand(),
            new VLineCommand(),
            new ShowCommand(),
        ));
    }

    /**
     * Return the canvas of this application instance
     *
     * @return Canvas 
     */
    public function getCanvas() {
        return $this->canvas;
    }
}
