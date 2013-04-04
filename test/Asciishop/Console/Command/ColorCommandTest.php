<?php 
namespace Test\Console\Command;

use Asciishop;
use Asciishop\Console\Command;

use Symfony\Component\Console\Tester\CommandTester;

class ColorCommandTest extends \PHPUnit_Framework_TestCase {

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
    public function testClear() {
        $this->console->add(new \Asciishop\Console\Command\ColorCommand());

        $this->console->getCanvas()->create(10,10);
        $grid = $this->console->getCanvas()->getGrid();

        // Verify canvas clear
        $command = $this->console->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 1,
            'y' => 1,
            'color' => 'X'
        ));

        $command = $this->console->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 1,
            'y' => 10,
            'color' => 'X'
        ));

        $command = $this->console->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 10,
            'y' => 1,
            'color' => 'X'
        ));

        $command = $this->console->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 10,
            'y' => 10,
            'color' => 'X'
        ));

        $grid = $this->console->getCanvas()->getGrid();

        $this->assertEquals($grid[1][1], 'X');
        $this->assertEquals($grid[10][1], 'X');
        $this->assertEquals($grid[10][1], 'X');
        $this->assertEquals($grid[10][10], 'X');
    }


    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testOutsideRange1() {
        $this->console->add(new \Asciishop\Console\Command\ColorCommand());

        $this->console->getCanvas()->create(10,10);
        $grid = $this->console->getCanvas()->getGrid();

        // Verify canvas clear
        $command = $this->console->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 0,
            'y' => 12,
            'color' => 'X'
        ));
    }

    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testOutsideRange2() {
        $this->console->add(new \Asciishop\Console\Command\ColorCommand());

        $this->console->getCanvas()->create(10,10);
        $grid = $this->console->getCanvas()->getGrid();

        // Verify canvas clear
        $command = $this->console->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 3,
            'y' => -1,
            'color' => 'X'
        ));
    }

    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testOutsideRange3() {
        $this->console->add(new \Asciishop\Console\Command\ColorCommand());

        $this->console->getCanvas()->create(10,10);
        $grid = $this->console->getCanvas()->getGrid();

        // Verify canvas clear
        $command = $this->console->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 0,
            'y' => 11,
            'color' => 'X'
        ));
    }

    /**
     *
     * @expectedException \Asciishop\CanvasException
     */
    public function testOutsideRange4() {
        $this->console->add(new \Asciishop\Console\Command\ColorCommand());

        $this->console->getCanvas()->create(10,10);
        $grid = $this->console->getCanvas()->getGrid();

        // Verify canvas clear
        $command = $this->console->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 1,
            'y' => 11,
            'color' => 'X'
        ));
    }
}
