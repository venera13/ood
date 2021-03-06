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

    protected function getCondimentDescription(): string
    {
        return 'Lemon * ' . $this->quantity;
    }

    protected function getCondimentCost(): int
    {
        return $this->quantity * 10;
    }
}