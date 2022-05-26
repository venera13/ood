<?php
declare(strict_types=1);

namespace State\Tests;

include '../GumballMachine/GumballMachineInterface.php';
include '../GumballMachine/GumballMachine.php';
include '../States/StateInterface.php';
include '../States/HasQuarterState.php';
include '../States/NoQuarterState.php';
include '../States/SoldOutState.php';
include '../States/SoldState.php';
include '../NaiveGumBallMachine/NaiveGumBallMachine.php';
include '../NaiveGumBallMachine/StateTypes.php';

use PHPUnit\Framework\TestCase;
use State\GumballMachine\GumballMachine;
use State\States\HasQuarterState;
use State\States\NoQuarterState;
use State\States\SoldOutState;
use State\States\SoldState;

class GumballMachineTest extends TestCase
{
    public function testGumballMachine()
    {
        $machine = new GumballMachine(5);
        $this->assertEquals(true, $machine->getBallCount() === 5);
    }

    public function testGumballMachineReleaseBall()
    {
        $machine = new GumballMachine(5);
        $machine->releaseBall();
        $this->assertEquals(true, $machine->getBallCount() === 4);
    }

    public function testGumballMachineFirstState()
    {
        $machine = new GumballMachine();

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new SoldOutState($machine);

        $this->assertEquals(true, $value == $rightValue);
    }

    public function testGumballMachineFirstState2()
    {
        $machine = new GumballMachine(2);

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new NoQuarterState($machine);

        $this->assertEquals(true, $value == $rightValue);
    }

    public function testNoQuarterStateInsertQuarter()
    {
        $machine = new GumballMachine();
        $state = new NoQuarterState($machine);
        $state->insertQuarter();

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new HasQuarterState($machine);

        $this->expectOutputString("You inserted a quarter<br />");
        $this->assertEquals(true, $value == $rightValue);
    }

    public function testNoQuarterStateEjectQuarter()
    {
        $machine = new GumballMachine();
        $state = new NoQuarterState($machine);
        $state->ejectQuarter();
        $this->expectOutputString("You haven't inserted a quarter<br />");
    }

    public function testNoQuarterStateTurnCrank()
    {
        $machine = new GumballMachine();
        $state = new NoQuarterState($machine);;
        $state->turnCrank();
        $this->expectOutputString("You turned but there's no quarter<br />");
    }

    public function testNoQuarterStateDispense()
    {
        $machine = new GumballMachine();
        $state = new NoQuarterState($machine);;
        $state->dispense();
        $this->expectOutputString("You need to pay first<br />");
    }

    public function testNoQuarterStateToString()
    {
        $machine = new GumballMachine();
        $state = new NoQuarterState($machine);
        $this->assertEquals(true, $state->toString() === "waiting for quarter");
    }

    public function testHasQuarterStateInsertQuarter()
    {
        $machine = new GumballMachine();
        $state = new HasQuarterState($machine);
        $state->insertQuarter();

        $value = $this->getProtectedProperty($machine, 'quarterCount');

        $this->expectOutputString("Insert quarter<br />");
        $this->assertEquals(true, $value == 1);
    }

    public function testHasQuarterStateEjectQuarter()
    {
        $machine = new GumballMachine();
        $state = new HasQuarterState($machine);
        $state->ejectQuarter();

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new NoQuarterState($machine);

        $this->expectOutputString("Quarter returned<br />");
        $this->assertEquals(true, $value == $rightValue);
    }

    public function testHasQuarterStateTurnCrank()
    {
        $machine = new GumballMachine();
        $state = new HasQuarterState($machine);;
        $state->turnCrank();

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new SoldState($machine);

        $this->expectOutputString("You turned...<br />");
        $this->assertEquals(true, $value == $rightValue);
    }

    public function testHasQuarterStateDispense()
    {
        $machine = new GumballMachine();
        $state = new HasQuarterState($machine);;
        $state->dispense();
        $this->expectOutputString("No gumball dispensed<br />");
    }

    public function testHasQuarterStateToString()
    {
        $machine = new GumballMachine();
        $state = new HasQuarterState($machine);
        $this->assertEquals(true, $state->toString() === "waiting for turn of crank");
    }

    public function testSoldOutStateInsertQuarter()
    {
        $machine = new GumballMachine();
        $state = new SoldOutState($machine);
        $state->insertQuarter();

        $this->expectOutputString("You can't insert a quarter, the machine is sold out<br />");
    }

    public function testSoldOutStateEjectQuarter()
    {
        $machine = new GumballMachine();
        $state = new SoldOutState($machine);
        $state->ejectQuarter();
        $this->expectOutputString("You can't eject, you haven't inserted a quarter yet<br />");
    }

    public function testSoldOutStateTurnCrank()
    {
        $machine = new GumballMachine();
        $state = new SoldOutState($machine);;
        $state->turnCrank();
        $this->expectOutputString("You turned but there's no gumballs<br />");
    }

    public function testSoldOutStateDispense()
    {
        $machine = new GumballMachine();
        $state = new SoldOutState($machine);
        $state->dispense();
        $this->expectOutputString("No gumball dispensed<br />");
    }

    public function testSoldOutStateToString()
    {
        $machine = new GumballMachine();
        $state = new SoldOutState($machine);
        $this->assertEquals(true, $state->toString() === "sold out");
    }

    public function testSoldStateInsertQuarter()
    {
        $machine = new GumballMachine();
        $state = new SoldState($machine);
        $state->insertQuarter();

        $value = $this->getProtectedProperty($machine, 'quarterCount');

        $this->expectOutputString("Insert quarter<br />");
        $this->assertEquals(true, $value == 1);
    }

    public function testSoldStateEjectQuarter()
    {
        $machine = new GumballMachine();
        $state = new SoldState($machine);
        $state->ejectQuarter();
        $this->expectOutputString("Sorry you already turned the crank<br />");
    }

    public function testSoldStateTurnCrank()
    {
        $machine = new GumballMachine();
        $state = new SoldState($machine);;
        $state->turnCrank();
        $this->expectOutputString("Turning twice doesn't get you another gumball<br />");
    }

    public function testSoldStateDispense()
    {
        $machine = new GumballMachine();
        $state = new SoldState($machine);
        $state->dispense();

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new SoldOutState($machine);

        $this->expectOutputString("Oops, out of gumballs<br />");

        $this->assertEquals(true, $value == $rightValue);
    }

    public function testSoldStateDispense2()
    {
        $machine = new GumballMachine(2);
        $state = new SoldState($machine);
        $state->dispense();

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new NoQuarterState($machine);

        $countValue = $this->getProtectedProperty($machine, 'ballCount');
        $countRightValue = 1;

        $this->assertEquals(true, $value == $rightValue);
        $this->assertEquals(true, $countValue == $countRightValue);
    }

    public function testSoldStateToString()
    {
        $machine = new GumballMachine();
        $state = new SoldState($machine);
        $this->assertEquals(true, $state->toString() === "delivering a gumball");
    }

    public function testAddQuarter()
    {
        $machine = new GumballMachine(1);
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
        $machine = new GumballMachine(1);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->ejectQuarter();

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new NoQuarterState($machine);

        $this->assertEquals(true, $machine->getQuarterCount() === 0);
        $this->assertEquals(true, $value == $rightValue);
    }

    public function testEjectQuarterFromSoldMachine()
    {
        $machine = new GumballMachine(2);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->ejectQuarter();

        $this->assertEquals(true, $machine->getQuarterCount() === 1);
    }

    public function testEjectQuarterFromSoldOutMachine()
    {
        $machine = new GumballMachine(1);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->ejectQuarter();

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new SoldOutState($machine);

        $this->assertEquals(true, $machine->getQuarterCount() === 0);
        $this->assertEquals(true, $value == $rightValue);
    }

    public function testRefill()
    {
        $machine = new GumballMachine(1);
        $machine->insertQuarter();
        $machine->refill(0);

        $quarterCount = $this->getProtectedProperty($machine, 'quarterCount');
        $state = $this->getProtectedProperty($machine, 'state');
        $rightState = new HasQuarterState($machine);

        $this->assertEquals(true, $quarterCount === 1);
        $this->assertEquals(true, $state == $rightState);
    }

    public function testRefill2()
    {
        $machine = new GumballMachine(1);
        $machine->insertQuarter();
        $machine->refill(2);

        $quarterCount = $this->getProtectedProperty($machine, 'quarterCount');
        $state = $this->getProtectedProperty($machine, 'state');
        $rightState = new HasQuarterState($machine);

        $this->assertEquals(true, $quarterCount === 1);
        $this->assertEquals(true, $state == $rightState);
    }

    public function testRefill3()
    {
        $machine = new GumballMachine(0);
        $machine->refill(0);

        $state = $this->getProtectedProperty($machine, 'state');
        $rightState = new SoldOutState($machine);

        $this->assertEquals(true, $state == $rightState);
    }

    public function testRefill4()
    {
        $machine = new GumballMachine(0);
        $state = new SoldState($machine);
        $state->refill(3);

        $value = $this->getProtectedProperty($machine, 'state');
        $rightValue = new SoldOutState($machine);

        $this->assertEquals(true, $value == $rightValue);
        $this->expectOutputString("Turning twice doesn't get you another gumball<br/>");
    }

    private function getProtectedProperty($object, $property)
    {
        $reflection = new \ReflectionClass($object);
        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }
}