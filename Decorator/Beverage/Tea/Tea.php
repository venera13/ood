<?php
declare(strict_types=1);

namespace Decorator\Beverage\Tea;

use Decorator\Beverage\BeverageInterface;

abstract class Tea implements BeverageInterface
{
    public function getDescription(): string
    {
        return ucfirst($this->getTeaType() . ' tea');
    }

    public function getCost(): int
    {
        return 30;
    }

    /**
     * @return string
     */
    public abstract function getTeaType(): string;
}