<?php
declare(strict_types=1);

namespace Decorator\Beverage\Coffee;

class Latte extends Coffee
{
    public function getStandardCost(): int
    {
        return 90;
    }

    public function getDoubleCost(): int
    {
        return 130;
    }
}