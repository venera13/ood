<?php
declare(strict_types=1);

namespace State\GumballMachine;

class GumballMachine
{
    /** @var GumballMachineContextInterface */
    private $gumballMachineContext;

    public function __construct(?int $ballCount = 0)
    {
        $this->gumballMachineContext = new GumballMachineContext($ballCount);
    }

    public function ejectQuarter(): void
    {
        $this->gumballMachineContext->ejectQuarter();
    }

    public function insertQuarter(): void
    {
        $this->gumballMachineContext->insertQuarter();
    }

    public function refill(int $numBalls): void
    {
        $this->gumballMachineContext->refill($numBalls);
    }

    public function turnCrank(): void
    {
        $this->gumballMachineContext->turnCrank();
    }

    public function toString(): void
    {
        $this->gumballMachineContext->toString();
    }
}