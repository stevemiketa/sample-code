<?php 
namespace Test\Console\Command;

use Asciishop;
use Asciishop\Console\Command;

use Symfony\Component\Console\Tester\CommandTester;

class FillCommandTest extends \PHPUnit_Framework_TestCase {

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
    public function testFill() {
        //$this->console->add(new \Asciishop\Console\Command\ClearCommand());
        $this->console->add(new \Asciishop\Console\Command\FillCommand());
        $this->console->add(new \Asciishop\Console\Command\HLineCommand());
        $this->console->add(new \Asciishop\Console\Command\VLineCommand());
        $this->console->add(new \Asciishop\Console\Command\ShowCommand());

        $this->console->getCanvas()->create(25,25);
        $grid = $this->console->getCanvas()->getGrid();

        // Fill Canvas 
        $fill_cmd = $this->console->find('F');
        $fillCommandTester = new CommandTester($fill_cmd);
        $fillCommandTester->execute(array(
            'command' => $fill_cmd->getName(), 
            'x' => 1, 
            'y' => 1, 
            'color' => 'F'
        ));

        // Verify canvas clear
        $command = $this->console->find('S');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $display = explode('\n', $commandTester->getDisplay());
        unset($display[0]);
        foreach ($display as $line) {
            list($rootX, $rootY) = $this->console->getCanvas()->getOrigin();

            $test_line = join(' ', array_fill($rootY, sizeof($grid[$rootX]), 'F'));
            $this->assertEquals($line, $test_line);
        }

        // Fill Canvas 
        $hlineCommand = $this->console->find('H');
        $hlineCommandTester = new CommandTester($hlineCommand);
        $hlineCommandTester->execute(array(
            'command' => $hlineCommand->getName(), 
            'x1' => 25, 
            'x2' => 1, 
            'y'=>5, 
            'color' => 'X'
        ));

        $hlineCommand = $this->console->find('H');
        $hlineCommandTester = new CommandTester($hlineCommand);
        $hlineCommandTester->execute(array(
            'command' => $hlineCommand->getName(), 
            'x1' => 25, 
            'x2' => 1, 
            'y'=> 20, 
            'color' => 'X'
        ));

        $vlineCommand = $this->console->find('V');
        $vlineCommandTester = new CommandTester($vlineCommand);
        $vlineCommandTester->execute(array(
            'command' => $vlineCommand->getName(), 
            'x' => 10, 
            'y1' => 1, 
            'y2' => 25, 
            'color' => 'X'
        ));

        // Fill canvas
        $fillCommandTester1 = new CommandTester($fill_cmd);
        $fillCommandTester1->execute(array(
            'command' => $fill_cmd->getName(), 
            'x' => 1, 
            'y'=>1, 
            'color' => 'A'
        ));

        // Fill canvas
        $fillCommandTester2 = new CommandTester($fill_cmd);
        $fillCommandTester2->execute(array(
            'command' => $fill_cmd->getName(), 
            'x' => 25, 
            'y'=>25, 
            'color' => 'B'
        ));

        // Fill canvas
        $fillCommandTester3 = new CommandTester($fill_cmd);
        $fillCommandTester3->execute(array(
            'command' => $fill_cmd->getName(), 
            'x' => 25, 
            'y'=> 1, 
            'color' => 'C'
        ));

        $commandTester->execute(array(
            'command' => $command->getName(), 
        ));

        $grid = $this->console->getCanvas()->getGrid();
        $this->assertEquals($grid[2][2], 'A');
        $this->assertEquals($grid[24][24], 'B');
        $this->assertEquals($grid[24][2], 'F');
        $this->assertEquals($grid[20][2], 'X');
        $this->assertEquals($grid[20][17], 'X');
        $this->assertEquals($grid[5][18], 'X');
        $this->assertEquals($grid[11][10], 'X');
        $this->assertEquals($grid[25][10], 'X');
        $this->assertEquals($grid[4][4], 'A');
        $this->assertEquals($grid[19][22], 'F');
    }

}
