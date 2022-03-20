<?php
declare(strict_types=1);

class Latte extends Coffee
{
    public function getDescription(): string
    {
        return 'Latte';
    }

    public function getCost(): int
    {
        return 90;
    }
}