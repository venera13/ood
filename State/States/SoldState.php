<?php
declare(strict_types=1);

namespace State\States;

use State\GumballMachine\GumballMachineInterface;

class SoldState implements StateInterface
{
    /** @var GumballMachineInterface */
    private $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        print_r("Please wait, we're already giving you a gumball<br />");
    }

    public function ejectQuarter(): void
    {
        print_r("Sorry you already turned the crank<br />");
    }

    public function turnCrank(): void
    {
        print_r("Turning twice doesn't get you another gumball<br />");
    }

    public function dispense(): void
    {
        $this->gumballMachine->releaseBall();
        if ($this->gumballMachine->getBallCount() === 0)
        {
            print_r("Oops, out of gumballs<br />");
            $this->gumballMachine->setSoldOutState();
        }
        else
        {
            $this->gumballMachine->setNoQuarterState();
        }
    }

    public function toString(): string
    {
        return "delivering a gumball";
    }
}