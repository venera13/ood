<?php
declare(strict_types=1);

class Lemon extends CondimentDecorator
{
    /** @var int */
    private $quantity;

    public function __construct(BeverageInterface $beverage, ?int $quantity = 1)
    {
        parent::__construct($beverage);

        $this->quantity = $quantity;
    }

    public function getCondimentDescription(): string
    {
        return 'Lemon * ' . $this->quantity;
    }

    public function getCondimentCost(): int
    {
        return $this->quantity * 10;
    }
}