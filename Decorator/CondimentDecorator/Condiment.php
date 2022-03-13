<?php
declare(strict_types=1);

class Condiment
{
    public static function makeCondiment(string $condiment, mixed $args = null): callable
    {
        return function(BeverageInterface $beverage) use ($condiment, $args)
        {
            return new $condiment($beverage, $args);
        };
    }
}