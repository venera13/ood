<?php
declare(strict_types=1);

namespace Factory\Shape;

use Factory\Canvas\CanvasInterface;

abstract class Shape implements ShapeInterface
{
    /** @var string */
    protected $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    //public abstract function draw(CanvasInterface $canvas): void;

    public function getColor(): string
    {
        return $this->color;
    }
}