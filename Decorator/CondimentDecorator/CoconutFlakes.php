<?php
declare(strict_types=1);

class CoconutFlakes extends CondimentDecorator
{
    public function getCondimentDescription(): string
    {
        return 'Coconut Flakes';
    }

    public function getCondimentCost(): int
    {
        return 20;
    }
}