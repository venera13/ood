<?php
declare(strict_types=1);

namespace Decorator\CondimentDecorator;

class Сream extends CondimentDecorator
{
    public function getCondimentDescription(): string
    {
        return 'Cream';
    }

    public function getCondimentCost(): int
    {
        return 25;
    }
}