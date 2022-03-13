<?php
declare(strict_types=1);

namespace Decorator\CondimentDecorator;

use Decorator\Beverage\BeverageInterface;

abstract class CondimentDecorator implements BeverageInterface
{
    /** @var BeverageInterface */
    private $beverage;

    public function __construct(BeverageInterface $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription(): string
    {
        return $this->beverage->getDescription() . ', ' . $this->getCondimentDescription();
    }

    public function getCost(): int
    {
        return $this->beverage->getCost() + $this->getCondimentCost();
    }

    /**
     * @return string
     */
    public abstract function getCondimentDescription(): string;

    /**
     * @return int
     */
    public abstract function getCondimentCost(): int;
}