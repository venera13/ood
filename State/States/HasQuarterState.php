<?php
declare(strict_types=1);

namespace State\States;

use State\GumballMachine\GumballMachineInterface;

class HasQuarterState implements StateInterface
{
    /** @var GumballMachineInterface */
    private $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        print_r("You can't insert another quarter<br />");
    }

    public function ejectQuarter(): void
    {
        print_r("Quarter returned<br />");
        $this->gumballMachine->setNoQuarterState();
    }

    public function turnCrank(): void
    {
        print_r("You turned...<br />");
        $this->gumballMachine->setSoldState();
    }

    public function dispense(): void
    {
        print_r("No gumball dispensed<br />");
    }

    public function toString(): string
    {
        return "waiting for turn of crank";
    }
}