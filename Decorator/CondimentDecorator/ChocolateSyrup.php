<?php
declare(strict_types=1);

class ChocolateSyrup extends CondimentDecorator
{
    public function getCondimentDescription(): string
    {
        return 'Chocolate Syrup';
    }

    public function getCondimentCost(): int
    {
        return 20;
    }
}