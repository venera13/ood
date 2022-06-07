<?php

namespace State\Tests;

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

        $this->expectOutputString("You inserted a quarter<br/>Insert quarter<br />Insert quarter<br />Insert quarter<br />Insert quarter<br />You can't insert another quarter<br/>");
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

        $this->expectOutputString("You inserted a quarter<br/>Insert quarter<br />Insert quarter<br />Insert quarter<br />Insert quarter<br />You can't insert another quarter<br/>Quarter returned<br/>");
    }

    public function testEjectQuarterFromSoldMachine()
    {
        $machine = new NaiveGumBallMachine(2);
        $machine->insertQuarter();
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->ejectQuarter();

        $this->expectOutputString("You inserted a quarter<br/>Insert quarter<br />You turned...<br/>A gumball comes rolling out the slot...<br/>You haven't inserted a quarter<br/>");
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

        $this->expectOutputString("You inserted a quarter<br/>Insert quarter<br />Insert quarter<br />Insert quarter<br />You turned...<br/>A gumball comes rolling out the slot...<br/>Oops, out of gumballs<br/>Quarters returned<br />");
    }

    public function testRefill()
    {
        $machine = new NaiveGumBallMachine(1);
        $machine->insertQuarter();
        $machine->refill(0);

        $this->expectOutputString("You inserted a quarter<br/>Refill<br/>");
    }

    public function testRefill2()
    {
        $machine = new NaiveGumBallMachine(1);
        $machine->insertQuarter();
        $machine->refill(2);

        $this->expectOutputString("You inserted a quarter<br/>Refill<br/>");
    }

    public function testRefill3()
    {
        $machine = new NaiveGumBallMachine(0);
        $machine->refill(0);

        $this->expectOutputString("Refill<br/>");
    }
}
