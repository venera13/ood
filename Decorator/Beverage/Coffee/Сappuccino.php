<?php
declare(strict_types=1);

class Сappuccino extends Coffee
{
    public function getDescription(): string
    {
        return 'Сappuccino';
    }

    public function getCost(): int
    {
        return 80;
    }
}