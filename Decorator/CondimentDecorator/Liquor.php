<?php
declare(strict_types=1);

class Liquor extends CondimentDecorator
{
    /** @var string */
    private $type;

    public function __construct(BeverageInterface $beverage, string $type)
    {
        parent::__construct($beverage);

        $this->type = $type;
    }

    public function getCondimentDescription(): string
    {
        return ucfirst($this->type . ' liquor');
    }

    public function getCondimentCost(): int
    {
        return 50;
    }
}