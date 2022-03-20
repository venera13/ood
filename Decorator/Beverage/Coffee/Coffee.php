<?php
declare(strict_types=1);

class Coffee implements BeverageInterface
{
    public function getDescription(): string
    {
        return 'coffee';
    }

    public function getCost(): int
    {
        return 70;
    }
}