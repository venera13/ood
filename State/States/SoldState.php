<?php
declare(strict_types=1);

namespace State\States;

use State\GumballMachine\GumballMachineContextInterface;

class SoldState implements StateInterface
{
    /** @var GumballMachineContextInterface */
    private $gumballMachine;

    public function __construct(GumballMachineContextInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        print_r("You can't insert another quarter<br />");
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
            if ($this->gumballMachine->getQuarterCount() === 0)
            {
                $this->gumballMachine->setNoQuarterState();
            }

            $this->gumballMachine->setHasQuarterState();
        }
    }

    public function toString(): string
    {
        return "delivering a gumball";
    }

    public function ejectAllQuarter(): void
    {
        print_r("You can't eject<br />");
    }

    public function refill(int $numBalls): void
    {
        print_r("Refill<br/>");
    }
}