<?php
declare(strict_types=1);

namespace State\States;

use State\GumballMachine\GumballMachineContextInterface;

class NoQuarterState implements StateInterface
{
    /** @var GumballMachineContextInterface */
    private $gumballMachine;

    public function __construct(GumballMachineContextInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        print_r("You inserted a quarter<br />");
        $this->gumballMachine->addQuarter();
        $this->gumballMachine->setHasQuarterState();
    }

    public function ejectQuarter(): void
    {
        print_r("You haven't inserted a quarter<br />");
    }

    public function ejectAllQuarter(): void
    {
        print_r("You haven't inserted a quarter<br />");
    }

    public function turnCrank(): void
    {
        print_r("You turned but there's no quarter<br />");
    }

    public function dispense(): void
    {
        print_r("You need to pay first<br />");
    }

    public function toString(): string
    {
        return "waiting for quarter";
    }

    public function refill(int $numBalls): void
    {
        print_r("Refill<br />");
        $this->gumballMachine->addBalls($numBalls);
        if ($this->gumballMachine->getBallCount() === 0)
        {
            $this->gumballMachine->setSoldOutState();
        }
    }
}