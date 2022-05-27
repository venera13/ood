<?php
declare(strict_types=1);

namespace State;

include 'GumballMachine/GumballMachineInterface.php';
include 'GumballMachine/GumballMachine.php';
include 'GumballMachine/GumballMachineContextInterface.php';
include 'GumballMachine/GumballMachineContext.php';
include 'States/StateInterface.php';
include 'States/HasQuarterState.php';
include 'States/NoQuarterState.php';
include 'States/SoldOutState.php';
include 'States/SoldState.php';
include 'NaiveGumBallMachine/NaiveGumBallMachine.php';
include 'NaiveGumBallMachine/StateTypes.php';

use State\GumballMachine\GumballMachine;

function testGumballMachine($machine)
{
    $machine->toString();

    $machine->insertQuarter();
    $machine->turnCrank();

    $machine->toString();

    $machine->insertQuarter();
    $machine->ejectQuarter();
    $machine->turnCrank();

    $machine->toString();

    $machine->insertQuarter();
    $machine->turnCrank();
    $machine->insertQuarter();
    $machine->turnCrank();
    $machine->ejectQuarter();

    $machine->toString();

    $machine->insertQuarter();
    $machine->insertQuarter();
    $machine->turnCrank();
    $machine->insertQuarter();
    $machine->turnCrank();
    $machine->insertQuarter();
    $machine->turnCrank();

    $machine->toString();
}

$machine = new GumballMachine(5);
testGumballMachine($machine);

//$naiveGumBallMachine = new NaiveGumBallMachine(5);
//testGumballMachine($naiveGumBallMachine);