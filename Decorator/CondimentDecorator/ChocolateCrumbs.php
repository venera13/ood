<?php
declare(strict_types=1);

class ChocolateCrumbs extends CondimentDecorator
{
    public function getCondimentDescription(): string
    {
        return 'Chocolate crumbs';
    }

    public function getCondimentCost(): int
    {
        return 15;
    }
}