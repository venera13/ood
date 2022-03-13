<?php
declare(strict_types=1);

namespace Decorator\CondimentDecorator;

use Decorator\Beverage\BeverageInterface;

class Chocolate extends CondimentDecorator
{
    /** @var int */
    private $quantity;

    public function __construct(BeverageInterface $beverage, ?int $quantity = 1)
    {
        parent::__construct($beverage);

        if ($quantity > 5)
        {
            print_r('Max quantity chocolate is 5</br>');
            $this->quantity = 5;
        }
        else
        {
            $this->quantity = $quantity;
        }
    }

    public function getCondimentDescription(): string
    {
        return 'Chocolate * ' . $this->quantity;
    }

    public function getCondimentCost(): int
    {
        return 10 * $this->quantity;
    }
}