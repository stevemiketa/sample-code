<?php 
namespace Test\Console\Command;

use Asciishop;
use Asciishop\Console\Command;

use Symfony\Component\Console\Tester\CommandTester;

class CreateCommandTest extends \PHPUnit_Framework_TestCase {

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
        $this->console->add(new \Asciishop\Console\Command\ShowCommand());

        $this->console->getCanvas()->create(10,10);
        $grid = $this->console->getCanvas()->getGrid();

        // Verify canvas clear
        $command = $this->console->find('S');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $display = explode('\n', $commandTester->getDisplay());
        unset($display[0]);
        foreach ($display as $line) {
            list($rootX, $rootY) = $this->console->getCanvas()->getOrigin();

            $test_line = join(' ', array_fill($rootY, sizeof($grid[$rootX]), $this->console->getCanvas()->getDefaultColor()));
            $this->assertEquals($line, $test_line);
        }
    }
}
