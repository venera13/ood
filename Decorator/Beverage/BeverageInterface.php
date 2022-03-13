<?php
declare(strict_types=1);

namespace Decorator\Beverage;

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