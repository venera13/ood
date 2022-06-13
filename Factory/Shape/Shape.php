<?php
declare(strict_types=1);

namespace Factory\Shape;

abstract class Shape implements ShapeInterface
{
    /** @var string */
    protected $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}