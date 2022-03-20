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

    protected function getCondimentDescription(): string
    {
        return ucfirst($this->type . ' liquor');
    }

    protected function getCondimentCost(): int
    {
        return 50;
    }
}