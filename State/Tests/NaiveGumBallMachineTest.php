<?php

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
use State\NaiveGumBallMachine\NaiveGumBallMachine;
use State\NaiveGumBallMachine\StateTypes;

class NaiveGumBallMachineTest extends TestCase
{
    public function testAddQuarter()
    {
        $machine = new NaiveGumBallMachine(1);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();

        $quarterCount = $this->getProtectedProperty($machine, 'quarterCount');
        $this->assertEquals(true, $quarterCount === 5);
    }

    public function testDecreaseQuarter()
    {
        $machine = new NaiveGumBallMachine(1);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->ejectQuarter();

        $quarterCount = $this->getProtectedProperty($machine, 'quarterCount');
        $state = $this->getProtectedProperty($machine, 'state');

        $this->assertEquals(true, $quarterCount === 0);
        $this->assertEquals(true, $state == StateTypes::NO_QUARTER);
    }

    public function testEjectQuarterFromSoldMachine()
    {
        $machine = new NaiveGumBallMachine(2);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->ejectQuarter();

        $quarterCount = $this->getProtectedProperty($machine, 'quarterCount');
        $this->assertEquals(true, $quarterCount === 1);
    }

    public function testEjectQuarterFromSoldOutMachine()
    {
        $machine = new NaiveGumBallMachine(1);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->ejectQuarter();

        $quarterCount = $this->getProtectedProperty($machine, 'quarterCount');
        $state = $this->getProtectedProperty($machine, 'state');

        $this->assertEquals(true, $quarterCount === 0);
        $this->assertEquals(true, $state == StateTypes::SOLD_OUT);
    }

    public function testRefill()
    {
        $machine = new NaiveGumBallMachine(1);
        $machine->insertQuarter();
        $machine->refill(0);

        $quarterCount = $this->getProtectedProperty($machine, 'quarterCount');
        $state = $this->getProtectedProperty($machine, 'state');

        $this->assertEquals(true, $quarterCount === 1);
        $this->assertEquals(true, $state == StateTypes::HAS_QUARTER);
    }

    public function testRefill2()
    {
        $machine = new NaiveGumBallMachine(1);
        $machine->insertQuarter();
        $machine->refill(2);

        $quarterCount = $this->getProtectedProperty($machine, 'quarterCount');
        $state = $this->getProtectedProperty($machine, 'state');

        $this->assertEquals(true, $quarterCount === 1);
        $this->assertEquals(true, $state == StateTypes::HAS_QUARTER);
    }

    public function testRefill3()
    {
        $machine = new NaiveGumBallMachine(0);
        $machine->refill(0);

        $state = $this->getProtectedProperty($machine, 'state');

        $this->assertEquals(true, $state == StateTypes::SOLD_OUT);
    }

    private function getProtectedProperty($object, $property)
    {
        $reflection = new \ReflectionClass($object);
        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }
}
