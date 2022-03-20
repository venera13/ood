<?php
declare(strict_types=1);

class Сream extends CondimentDecorator
{
    protected function getCondimentDescription(): string
    {
        return 'Cream';
    }

    protected function getCondimentCost(): int
    {
        return 25;
    }
}