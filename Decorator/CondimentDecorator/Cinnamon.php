<?php
declare(strict_types=1);

namespace Decorator\CondimentDecorator;

class Cinnamon extends CondimentDecorator
{
    public function getCondimentDescription(): string
    {
        return 'Cinnamon';
    }

    public function getCondimentCost(): int
    {
        return 20;
    }
}