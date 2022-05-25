<?php
declare(strict_types=1);

namespace State\GumballMachine;

use State\States\HasQuarterState;
use State\States\NoQuarterState;
use State\States\SoldOutState;
use State\States\SoldState;
use State\States\StateInterface;

class GumballMachine implements GumballMachineInterface
{
    /** @var int */
    private $count;
    /** @var SoldState */
    private $soldState;
    /** @var SoldOutState */
    private $soldOutState;
    /** @var NoQuarterState */
    private $noQuarterState;
    /** @var HasQuarterState */
    private $hasQuarterState;
    /** @var StateInterface */
    private $state;

    public function __construct(?int $count = 0)
    {
        $this->count = $count;
        $this->soldState = new SoldState($this);
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);

        if ($count > 0)
        {
            $this->state = $this->noQuarterState;
        }
        else
        {
            $this->state = $this->soldOutState;
        }
    }

    public function ejectQuarter(): void
    {
        $this->state->ejectQuarter();
    }

    public function insertQuarter(): void
    {
        $this->state->insertQuarter();
    }

    public function turnCrank(): void
    {
        $this->state->turnCrank();
        $this->state->dispense();
    }

    public function toString(): void
    {
        $gumballEnding = $this->count !== 1 ? "s" : "";
        print_r("Inventory: " . $this->count . " gumball" . $gumballEnding . "<br />");
        print_r("Machine is " . $this->state->toString() . "<br />");
        print_r("----------<br />");
    }

    public function releaseBall(): void
    {
        if ($this->count !== 0)
        {
            print_r("A gumball comes rolling out the slot...<br/>");
            --$this->count;
        }
    }

    public function getBallCount(): int
    {
        return $this->count;
    }

    public function setSoldOutState(): void
    {
        $this->state = $this->soldOutState;
    }

    public function setNoQuarterState(): void
    {
        $this->state = $this->noQuarterState;
    }

    public function setSoldState(): void
    {
        $this->state = $this->soldState;
    }

    public function setHasQuarterState(): void
    {
        $this->state = $this->hasQuarterState;
    }
}