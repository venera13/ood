<?php
declare(strict_types=1);

class ChocolateCrumbs extends CondimentDecorator
{
    protected function getCondimentDescription(): string
    {
        return 'Chocolate crumbs';
    }

    protected function getCondimentCost(): int
    {
        return 15;
    }
}