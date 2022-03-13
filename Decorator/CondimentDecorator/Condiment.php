<?php
declare(strict_types=1);

namespace Decorator\CondimentDecorator;

use Decorator\Beverage\BeverageInterface;

class Condiment
{
    public static function makeCondiment(string $condiment, mixed $args = null): callable
    {
        return function(BeverageInterface $beverage) use ($condiment, $args)
        {
            $condiment = '\Decorator\CondimentDecorator\\' . $condiment;
            return new $condiment($beverage, $args);
        };
    }
}