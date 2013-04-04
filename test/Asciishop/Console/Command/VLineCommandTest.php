<?php 
namespace Test\Console\Command;

use Asciishop;
use Asciishop\Console\Command;

use Symfony\Component\Console\Tester\CommandTester;

class VLineCommandTest extends \PHPUnit_Framework_TestCase {

    protected $canvas;
    protected $console;

    protected function setUp() {
        $this->canvas = new \Asciishop\Canvas();
        $this->console = new \Asciishop\Asciishop($this->canvas);

    }

    protected function tearDown() {

    }


    /**
     *
     *
     */
    public function testVLine() {
        $this->console->add(new \Asciishop\Console\Command\VLineCommand());
        $this->console->add(new \Asciishop\Console\Command\ShowCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $vlineCommand = $this->console->find('V');
        $vlineCommandTester = new CommandTester($vlineCommand);
        $vlineCommandTester->execute(array(
            'command' => $vlineCommand->getName(), 
            'x' => 25, 
            'y1' => 1, 
            'y2'=>25, 
            'color' => 'X'
        ));

        $vlineCommand = $this->console->find('V');
        $vlineCommandTester = new CommandTester($vlineCommand);
        $vlineCommandTester->execute(array(
            'command' => $vlineCommand->getName(), 
            'x' => 1, 
            'y1' => 1, 
            'y2'=> 25, 
            'color' => 'X'
        ));


        $grid = $this->console->getCanvas()->getGrid();
        foreach ($grid as $idx=>$color) {
            $this->assertEquals($grid[$idx][1], 'X');
            $this->assertEquals($grid[$idx][25], 'X');
        }
        for ($i=1; $i<=25; $i++) {
            for ($j=2; $j<=24; $j++) {
                $this->assertEquals($grid[$i][$j], 'O');
            }
        }
    }

    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testVLineFail1() {
        $this->console->add(new \Asciishop\Console\Command\VLineCommand());
        $this->console->add(new \Asciishop\Console\Command\ShowCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $vlineCommand = $this->console->find('V');
        $vlineCommandTester = new CommandTester($vlineCommand);
        $vlineCommandTester->execute(array(
            'command' => $vlineCommand->getName(), 
            'x' => 25, 
            'y1' => 1, 
            'y2'=>26, 
            'color' => 'X'
        ));
    }
    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testVLineFail2() {
        $this->console->add(new \Asciishop\Console\Command\VLineCommand());
        $this->console->add(new \Asciishop\Console\Command\ShowCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $vlineCommand = $this->console->find('V');
        $vlineCommandTester = new CommandTester($vlineCommand);
        $vlineCommandTester->execute(array(
            'command' => $vlineCommand->getName(), 
            'x' => 309, 
            'y1' => 1, 
            'y2'=>17, 
            'color' => 'X'
        ));
    }
    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testVLineFail3() {
        $this->console->add(new \Asciishop\Console\Command\VLineCommand());
        $this->console->add(new \Asciishop\Console\Command\ShowCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $vlineCommand = $this->console->find('V');
        $vlineCommandTester = new CommandTester($vlineCommand);
        $vlineCommandTester->execute(array(
            'command' => $vlineCommand->getName(), 
            'x' => 25, 
            'y1' => -10, 
            'y2'=>26, 
            'color' => 'X'
        ));
    }
    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testVLineFail4() {
        $this->console->add(new \Asciishop\Console\Command\VLineCommand());
        $this->console->add(new \Asciishop\Console\Command\ShowCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $vlineCommand = $this->console->find('V');
        $vlineCommandTester = new CommandTester($vlineCommand);
        $vlineCommandTester->execute(array(
            'command' => $vlineCommand->getName(), 
            'x' => -25, 
            'y1' => 109, 
            'y2'=>26, 
            'color' => 'X'
        ));
    }
}
