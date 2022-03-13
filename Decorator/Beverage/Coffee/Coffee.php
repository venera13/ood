<?php
declare(strict_types=1);

abstract class Coffee implements BeverageInterface
{
    /** @var string */
    private $portion;

    public function __construct(?string $portion = CoffeePortionType::STANDARD)
    {
        $this->portion = $portion;
    }

    public function getDescription(): string
    {
        $description = 'coffee';
        return ucfirst($this->portion === CoffeePortionType::DOUBLE ? $this->portion . ' ' . $description : $description);
    }

    public function getCost(): int
    {
        return $this->portion === CoffeePortionType::DOUBLE ? $this->getDoubleCost() : $this->getStandardCost();
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