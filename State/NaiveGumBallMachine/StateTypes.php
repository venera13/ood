<?php
declare(strict_types=1);

namespace State\NaiveGumBallMachine;

class StateTypes
{
    const SOLD_OUT = "SoldOut";
    const NO_QUARTER = "NoQuarter";
    const HAS_QUARTER = "HasQuarter";
    const SOLD = "Sold";
}