<?php
declare(strict_types=1);

namespace Decorator\Beverage\Coffee;

use Decorator\Beverage\BeverageInterface;
use Decorator\Domain\CoffeePortionTypes;

abstract class Coffee implements BeverageInterface
{
    /** @var string */
    private $portion;

    public function __construct(?string $portion = CoffeePortionTypes::STANDARD)
    {
        $this->portion = $portion;
    }

    public function getDescription(): string
    {
        $description = 'coffee';
        return ucfirst($this->portion === CoffeePortionTypes::DOUBLE ? $this->portion . ' ' . $description : $description);
    }

    public function getCost(): int
    {
        return $this->portion === CoffeePortionTypes::DOUBLE ? $this->getDoubleCost() : $this->getStandardCost();
    }

    /**
     * @return int
     */
    public abstract function getStandardCost(): int;

    /**
     * @return int
     */
    public abstract function getDoubleCost(): int;
}