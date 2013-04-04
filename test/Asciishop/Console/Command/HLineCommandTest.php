<?php 
namespace Test\Console\Command;

use Asciishop;
use Asciishop\Console\Command;

use Symfony\Component\Console\Tester\CommandTester;

class HLineCommandTest extends \PHPUnit_Framework_TestCase {

    protected $canvas;
    protected $console;

    protected function setUp() {
        $this->canvas = new \Asciishop\Canvas();
        $this->console = new \Asciishop\Asciishop($this->canvas);

    }

    protected function tearDown() {

    }


    public function testHLine() {
        $this->console->add(new \Asciishop\Console\Command\HLineCommand());
        $this->console->add(new \Asciishop\Console\Command\ShowCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $hlineCommand = $this->console->find('H');
        $hlineCommandTester = new CommandTester($hlineCommand);
        $hlineCommandTester->execute(array(
            'command' => $hlineCommand->getName(), 
            'x1' => 25, 
            'x2' => 1, 
            'y'=>25, 
            'color' => 'X'
        ));
        
        // Fill Canvas 
        $hlineCommand = $this->console->find('H');
        $hlineCommandTester = new CommandTester($hlineCommand);
        $hlineCommandTester->execute(array(
            'command' => $hlineCommand->getName(), 
            'x1' => 25, 
            'x2' => 1, 
            'y'=>1, 
            'color' => 'X'
        ));


        $grid = $this->console->getCanvas()->getGrid();
        foreach ($grid[1] as $idx=>$color) {
            $this->assertEquals($color, 'X');
        }
        foreach ($grid[25] as $idx=>$color) {
            $this->assertEquals($color, 'X');
        }
        for ($i=1; $i<=25; $i++) {
            for ($j=2; $j<=24; $j++) {
                $this->assertEquals($grid[$j][$i], 'O');
            }
        }
    }

    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testHLineFail1() {
        $this->console->add(new \Asciishop\Console\Command\HLineCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $hlineCommand = $this->console->find('H');
        $hlineCommandTester = new CommandTester($hlineCommand);
        $hlineCommandTester->execute(array(
            'command' => $hlineCommand->getName(), 
            'x1' => -25, 
            'x2' => 1, 
            'y'=>1, 
            'color' => 'X'
        ));
    }
    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testHLineFail2() {
        $this->console->add(new \Asciishop\Console\Command\HLineCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $hlineCommand = $this->console->find('H');
        $hlineCommandTester = new CommandTester($hlineCommand);
        $hlineCommandTester->execute(array(
            'command' => $hlineCommand->getName(), 
            'x1' => 37, 
            'x2' => 15, 
            'y'=>1, 
            'color' => 'X'
        ));
    }
    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testHLineFail3() {
        $this->console->add(new \Asciishop\Console\Command\HLineCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $hlineCommand = $this->console->find('H');
        $hlineCommandTester = new CommandTester($hlineCommand);
        $hlineCommandTester->execute(array(
            'command' => $hlineCommand->getName(), 
            'x1' => 25, 
            'x2' => 1, 
            'y'=>26, 
            'color' => 'X'
        ));
    }
    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testHLineFail4() {
        $this->console->add(new \Asciishop\Console\Command\HLineCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $hlineCommand = $this->console->find('H');
        $hlineCommandTester = new CommandTester($hlineCommand);
        $hlineCommandTester->execute(array(
            'command' => $hlineCommand->getName(), 
            'x1' => 25, 
            'x2' => 1, 
            'y'=>0, 
            'color' => 'X'
        ));
    }
}
