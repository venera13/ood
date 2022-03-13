<?php
declare(strict_types=1);

class IceCube extends CondimentDecorator
{
    /** @var int */
    private $quantity;
    /** @var int */
    private $type;

    public function __construct(BeverageInterface $beverage, ?int $quantity = 1, string $type = IceCubeType::WATER)
    {
        parent::__construct($beverage);

        $this->quantity = $quantity;
        $this->type = $type;
    }

    public function getCondimentDescription(): string
    {
        return $this->type . ' ice * ' . $this->quantity;
    }

    public function getCondimentCost(): int
    {
        return 5 * $this->quantity;
    }
}