<?php
declare(strict_types=1);

namespace State\NaiveGumBallMachine;

class NaiveGumBallMachine
{
    /** @var int */
    private $count;
    /** @var StateTypes */
    private $state;

    public function __construct(?int $count = 0)
    {
        $this->count = $count;

        if ($count > 0)
        {
            $this->state = StateTypes::NO_QUARTER;
        }
        else
        {
            $this->state = StateTypes::SOLD_OUT;
        }
    }

    public function insertQuarter(): void
    {
        switch ($this->state)
        {
            case StateTypes::SOLD_OUT:
                print_r("You can't insert a quarter, the machine is sold out<br/>");
                break;
            case StateTypes::NO_QUARTER:
                print_r("You inserted a quarter<br/>");
                $this->state = StateTypes::HAS_QUARTER;
                break;
            case StateTypes::HAS_QUARTER:
                print_r("You can't insert another quarter<br/>");
                break;
            case StateTypes::SOLD:
                print_r("Please wait, we're already giving you a gumball<br/>");
                break;
        }
    }
    
    public function ejectQuarter(): void
    {
        switch ($this->state)
        {
            case StateTypes::HAS_QUARTER:
                print_r("Quarter returned<br/>");
                $this->state = StateTypes::NO_QUARTER;
                break;
            case StateTypes::SOLD_OUT:
                print_r("You can't eject, you haven't inserted a quarter yet<br/>");
                break;
            case StateTypes::NO_QUARTER:
                print_r("You haven't inserted a quarter<br/>");
                break;
            case StateTypes::SOLD:
                print_r("Sorry you already turned the crank<br/>");
                break;
        }
    }

    public function turnCrank(): void
    {
        switch ($this->state)
        {
            case StateTypes::SOLD_OUT:
                print_r("You turned but there's no gumballs<br/>");
                break;
            case StateTypes::HAS_QUARTER:
                print_r("You turned...<br/>");
                $this->state = StateTypes::SOLD;
                $this->dispense();
                break;
            case StateTypes::NO_QUARTER:
                print_r("You turned but there's no quarter<br/>");
                break;
            case StateTypes::SOLD:
                print_r("Turning twice doesn't get you another gumball<br/>");
                break;
        }
    }

    public function refill(int $numBalls): void
    {
        $this->count = $numBalls;
        $this->state = $numBalls > 0 ? StateTypes::NO_QUARTER : StateTypes::SOLD_OUT;
    }

    public function toString(): void
    {
        switch ($this->state)
        {
            case StateTypes::SOLD_OUT:
                $state = "sold out";
                break;
            case StateTypes::NO_QUARTER:
                $state = "waiting for quarter";
                break;
            case StateTypes::HAS_QUARTER:
                $state = "waiting for turn of crank";
                break;
            default:
                $state = "delivering a gumball";
                break;
        }

        $gumballEnding = $this->count !== 1 ? "s" : "";
        print_r("Inventory: " . $this->count . " gumball" . $gumballEnding . "<br />");
        print_r("Machine is " . $state . "<br />");
        print_r("----------<br />");
    }

    private function dispense(): void
    {
        switch ($this->state)
        {
            case StateTypes::SOLD:
                print_r("A gumball comes rolling out the slot...<br/>");
                --$this->count;
                if ($this->count === 0)
                {
                    print_r("Oops, out of gumballs<br/>");
                    $this->state = StateTypes::SOLD_OUT;
                }
                else
                {
                    $this->state = StateTypes::NO_QUARTER;
                }
                break;
            case StateTypes::NO_QUARTER:
                print_r("You need to pay first<br/>");
                break;
            case StateTypes::SOLD_OUT:
            case StateTypes::HAS_QUARTER:
                print_r("No gumball dispensed<br/>");
                break;
        }
    }
}