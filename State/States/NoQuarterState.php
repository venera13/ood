<?php
declare(strict_types=1);

namespace State\States;

use State\GumballMachine\GumballMachineInterface;

class NoQuarterState implements StateInterface
{
    /** @var GumballMachineInterface */
    private $gumballMachine;

    public function __construct(GumballMachineInterface $gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter(): void
    {
        print_r("You inserted a quarter<br />");
        $this->gumballMachine->setHasQuarterState();
    }

    public function ejectQuarter(): void
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
}