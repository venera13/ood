<?php
declare(strict_types=1);

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