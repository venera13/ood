<?php
declare(strict_types=1);

interface BeverageInterface
{
    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return int
     */
    public function getCost(): int;
}