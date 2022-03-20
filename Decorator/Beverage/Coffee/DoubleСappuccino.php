<?php
declare(strict_types=1);

class DoubleСappuccino extends Coffee
{
    public function getDescription(): string
    {
        return 'Double cappuccino';
    }

    public function getCost(): int
    {
        return 120;
    }
}