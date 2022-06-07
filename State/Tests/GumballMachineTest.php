<?php
declare(strict_types=1);

namespace State\Tests;

include '../GumballMachine/GumballMachine.php';
include '../GumballMachine/GumballMachineContextInterface.php';
include '../GumballMachine/GumballMachineContext.php';
include '../States/StateInterface.php';
include '../States/HasQuarterState.php';
include '../States/NoQuarterState.php';
include '../States/SoldOutState.php';
include '../States/SoldState.php';
include '../NaiveGumBallMachine/NaiveGumBallMachine.php';
include '../NaiveGumBallMachine/StateTypes.php';
include 'Exceptions/ReturnException.php';

use PHPUnit\Framework\TestCase;
use State\GumballMachine\GumballMachineContext;
use State\States\HasQuarterState;
use State\States\NoQuarterState;
use State\States\SoldOutState;
use State\States\SoldState;

class GumballMachineTest extends TestCase
{
    public function testGumballMachine()
    {
        $machine = new GumballMachineContext(5);
        $this->assertEquals(true, $machine->getBallCount() === 5);
    }

    public function testGumballMachineReleaseBall()
    {
        $machine = new GumballMachineContext(5);
        $machine->releaseBall();
        $this->assertEquals(true, $machine->getBallCount() === 4);
    }

    public function testGumballMachineFirstState()
    {
        $machine = new GumballMachineContext();
        $machine->turnCrank();
        $this->expectOutputString("You turned but there's no gumballs<br />No gumball dispensed<br />");
    }

    public function testGumballMachineFirstState2()
    {
        $machine = new GumballMachineContext(2);
        $machine->ejectQuarter();
        $this->expectOutputString("You haven't inserted a quarter<br />");
    }

    public function testNoQuarterStateInsertQuarter()
    {
        $machine = new GumballMachineContext(2);
        $machine->insertQuarter();
        $this->expectOutputString("You inserted a quarter<br />");
    }

    public function testNoQuarterStateEjectQuarter()
    {
        $machine = new GumballMachineContext(2);
        $machine->ejectQuarter();
        $this->expectOutputString("You haven't inserted a quarter<br />");
    }

    public function testNoQuarterStateTurnCrank()
    {
        $machine = new GumballMachineContext();
        $machine->turnCrank();
        $this->expectOutputString("You turned but there's no gumballs<br />No gumball dispensed<br />");
    }

    public function testNoQuarterStateDispense()
    {
        $machine = new GumballMachineContext();
        $state = new NoQuarterState($machine);
        $state->dispense();
        $this->expectOutputString("You need to pay first<br />");
    }

    public function testNoQuarterStateToString()
    {
        $machine = new GumballMachineContext(2);
        $machine->toString();
        $this->expectOutputString("Inventory: 2 gumballs<br />Machine is waiting for quarter<br />----------<br />");
    }

    public function testHasQuarterStateInsertQuarter()
    {
        $machine = new GumballMachineContext(2);
        $machine->insertQuarter();
        $this->expectOutputString("You inserted a quarter<br />");
    }

    public function testHasQuarterStateEjectQuarter()
    {
        $machine = new GumballMachineContext(2);
        $machine->insertQuarter();
        $machine->ejectQuarter();
        $this->expectOutputString("You inserted a quarter<br />Quarters returned<br />The quarter is back<br/>");
    }

    public function testHasQuarterStateTurnCrank()
    {
        $machine = new GumballMachineContext(1);
        $machine->insertQuarter();
        $machine->turnCrank();
        $this->expectOutputString("You inserted a quarter<br />You turned...<br />The quarter is back<br/>A gumball comes rolling out the slot...<br/>Oops, out of gumballs<br />");
    }

    public function testHasQuarterStateDispense()
    {
        $machine = new GumballMachineContext();
        $state = new HasQuarterState($machine);;
        $state->dispense();
        $this->expectOutputString("No gumball dispensed<br />");
    }

    public function testHasQuarterStateToString()
    {
        $machine = new GumballMachineContext(1);
        $machine->insertQuarter();
        $machine->toString();
        $this->expectOutputString("You inserted a quarter<br />Inventory: 1 gumball<br />Machine is waiting for turn of crank<br />----------<br />");
    }

    public function testSoldOutStateInsertQuarter()
    {
        $machine = new GumballMachineContext();
        $machine->insertQuarter();
        $this->expectOutputString("You can't insert a quarter, the machine is sold out<br />");
    }

    public function testSoldOutStateEjectQuarter()
    {
        $machine = new GumballMachineContext();
        $machine->ejectQuarter();
        $this->expectOutputString("Quarters returned<br />");
    }

    public function testSoldOutStateTurnCrank()
    {
        $machine = new GumballMachineContext();
        $machine->turnCrank();
        $this->expectOutputString("You turned but there's no gumballs<br />No gumball dispensed<br />");
    }

    public function testSoldOutStateDispense()
    {
        $machine = new GumballMachineContext();
        $state = new SoldOutState($machine);
        $state->dispense();
        $this->expectOutputString("No gumball dispensed<br />");
    }

    public function testSoldOutStateToString()
    {
        $machine = new GumballMachineContext();
        $machine->toString();
        $this->expectOutputString("Inventory: 0 gumballs<br />Machine is sold out<br />----------<br />");
    }

    public function testSoldStateInsertQuarter()
    {
        $machine = new GumballMachineContext();
        $state = new SoldState($machine);
        $state->insertQuarter();
        $this->expectOutputString("You can't insert another quarter<br />");
    }

    public function testSoldStateEjectQuarter()
    {
        $machine = new GumballMachineContext();
        $state = new SoldState($machine);
        $state->ejectQuarter();
        $this->expectOutputString("Sorry you already turned the crank<br />");
    }

    public function testSoldStateTurnCrank()
    {
        $machine = new GumballMachineContext();
        $state = new SoldState($machine);;
        $state->turnCrank();
        $this->expectOutputString("Turning twice doesn't get you another gumball<br />");
    }

    public function testSoldStateDispense()
    {
        $machine = new GumballMachineContext();
        $state = new SoldState($machine);
        $state->dispense();

        $this->expectOutputString("Oops, out of gumballs<br />");
    }

    public function testSoldStateDispense2()
    {
        $machine = new GumballMachineContext(2);
        $state = new SoldState($machine);
        $state->dispense();
        $this->assertEquals(true, $machine->getBallCount() == 1);
    }

    public function testSoldStateToString()
    {
        $machine = new GumballMachineContext();
        $state = new SoldState($machine);
        $this->assertEquals(true, $state->toString() === "delivering a gumball");
    }

    public function testAddQuarter()
    {
        $machine = new GumballMachineContext(1);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();

        $this->assertEquals(true, $machine->getQuarterCount() === 5);
    }

    public function testDecreaseQuarter()
    {
        $machine = new GumballMachineContext(1);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->ejectQuarter();

        $this->assertEquals(true, $machine->getQuarterCount() === 0);
    }

    public function testEjectQuarterFromSoldMachine()
    {
        $machine = new GumballMachineContext(2);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->ejectQuarter();

        $this->assertEquals(true, $machine->getQuarterCount() === 0);
    }

    public function testEjectQuarterFromSoldOutMachine()
    {
        $machine = new GumballMachineContext(1);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->ejectQuarter();

        $this->assertEquals(true, $machine->getQuarterCount() === 0);
    }

    public function testRefill()
    {
        $machine = new GumballMachineContext(1);
        $machine->insertQuarter();
        $machine->refill(0);

        $this->assertEquals(true, $machine->getQuarterCount() === 1);
    }

    public function testRefill2()
    {
        $machine = new GumballMachineContext(1);
        $machine->insertQuarter();
        $machine->refill(2);

        $this->assertEquals(true, $machine->getQuarterCount() === 1);
    }
}