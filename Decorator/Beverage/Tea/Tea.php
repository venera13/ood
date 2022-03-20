<?php
declare(strict_types=1);

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
    protected abstract function getTeaType(): string;
}