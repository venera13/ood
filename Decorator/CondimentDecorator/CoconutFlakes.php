<?php
declare(strict_types=1);

class CoconutFlakes extends CondimentDecorator
{
    protected function getCondimentDescription(): string
    {
        return 'Coconut Flakes';
    }

    protected function getCondimentCost(): int
    {
        return 20;
    }
}