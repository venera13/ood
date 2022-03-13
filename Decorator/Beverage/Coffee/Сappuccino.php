<?php
declare(strict_types=1);

class Сappuccino extends Coffee
{
    public function getStandardCost(): int
    {
        return 80;
    }

    public function getDoubleCost(): int
    {
        return 120;
    }
}