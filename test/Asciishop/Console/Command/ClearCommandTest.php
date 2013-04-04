<?php 
namespace Test\Console\Command;

use Asciishop;
use Asciishop\Console\Command;


class ClearCommandTest extends \PHPUnit_Framework_TestCase {

    protected $canvas;
    protected $console;

    protected function setUp() {
        $this->canvas = new \Asciishop\Canvas();
        $this->console = new \Asciishop\Asciishop($this->canvas);

    }

    protected function tearDown() {

    }


    public function testClear() {
        $this->console->add(new \Asciishop\Console\Command\ClearCommand());

        $this->console->getCanvas()->create(10,10);
        $grid = $this->console->getCanvas()->getGrid();

        foreach ($grid as $row=>$colData) {
            foreach ($colData as $col=>$color) {
                if ($color != $this->console->getCanvas()->getDefaultColor())
                    throw new Exception("Failed to fill canvas with appropriate default color");
            }
        }
    }

}
