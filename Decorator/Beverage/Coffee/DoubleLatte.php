<?php
declare(strict_types=1);

class DoubleLatte extends Coffee
{
    public function getDescription(): string
    {
        return 'Double latte';
    }

    public function getCost(): int
    {
        return 130;
    }
}