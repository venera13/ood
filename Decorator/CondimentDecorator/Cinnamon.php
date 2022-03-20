<?php
declare(strict_types=1);

class Cinnamon extends CondimentDecorator
{
    protected function getCondimentDescription(): string
    {
        return 'Cinnamon';
    }

    protected function getCondimentCost(): int
    {
        return 20;
    }
}