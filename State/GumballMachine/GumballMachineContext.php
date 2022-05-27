<?php
declare(strict_types=1);

namespace State\GumballMachine;

use State\States\HasQuarterState;
use State\States\NoQuarterState;
use State\States\SoldOutState;
use State\States\SoldState;
use State\States\StateInterface;

class GumballMachineContext implements GumballMachineContextInterface
{
    /** @var int */
    private $ballCount;
    /** @var int */
    private $quarterCount = 0;
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

    public function __construct(?int $ballCount = 0)
    {
        $this->ballCount = $ballCount;
        $this->soldState = new SoldState($this);
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);

        if ($ballCount > 0)
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
        $this->state->ejectAllQuarter();
    }

    public function insertQuarter(): void
    {
        $this->state->insertQuarter();
    }

    public function refill(int $numBalls): void
    {
        $this->state->refill($numBalls);
    }

    public function turnCrank(): void
    {
        $this->state->turnCrank();
        $this->state->dispense();
    }

    public function toString(): void
    {
        $gumballEnding = $this->ballCount !== 1 ? "s" : "";
        print_r("Inventory: " . $this->ballCount . " gumball" . $gumballEnding . "<br />");
        print_r("Machine is " . $this->state->toString() . "<br />");
        print_r("----------<br />");
    }

    public function addQuarter(): void
    {
        $this->quarterCount++;
    }

    public function addBalls(int $numBalls): void
    {
        $this->ballCount += $numBalls;
    }

    public function decreaseQuarter(): void
    {
        if ($this->quarterCount !== 0)
        {
            print_r("The quarter is back<br/>");
            --$this->quarterCount;
        }
    }

    public function releaseBall(): void
    {
        if ($this->ballCount !== 0)
        {
            print_r("A gumball comes rolling out the slot...<br/>");
            --$this->ballCount;
        }
    }

    public function getBallCount(): int
    {
        return $this->ballCount;
    }

    public function getQuarterCount(): int
    {
        return $this->quarterCount;
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