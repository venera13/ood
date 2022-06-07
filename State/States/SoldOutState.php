<?php
declare(strict_types=1);

namespace State\States;

use State\GumballMachine\GumballMachineContextInterface;

class SoldOutState implements StateInterface
{
    /** @var GumballMachineContextInterface */
    private $gumballMachine;

    public function __construct(GumballMachineContextInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        print_r("You can't insert a quarter, the machine is sold out<br />");
    }

    public function ejectQuarter(): void
    {
        print_r("You can't eject, you haven't inserted a quarter yet<br />");
    }

    public function turnCrank(): void
    {
        print_r("You turned but there's no gumballs<br />");
    }

    public function dispense(): void
    {
        print_r("No gumball dispensed<br />");
    }

    public function toString(): string
    {
        return "sold out";
    }

    public function ejectAllQuarter(): void
    {
        print_r("Quarters returned<br />");
        $quarterCount = $this->gumballMachine->getQuarterCount();
        for ($i = 0; $i < $quarterCount; $i++)
        {
            $this->gumballMachine->decreaseQuarter();
        }
    }

    public function refill(int $numBalls): void
    {
        print_r("Refill<br />");
        $this->gumballMachine->addBalls($numBalls);
        if ($this->gumballMachine->getQuarterCount() > 0)
        {
            $this->gumballMachine->setHasQuarterState();
        }
        else
        {
            $this->gumballMachine->setNoQuarterState();
        }
    }
}