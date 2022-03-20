<?php
declare(strict_types=1);

class ChocolateSyrup extends CondimentDecorator
{
    protected function getCondimentDescription(): string
    {
        return 'Chocolate Syrup';
    }

    protected function getCondimentCost(): int
    {
        return 20;
    }
}