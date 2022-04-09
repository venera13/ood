<?php
declare(strict_types=1);

namespace Factory\Shape;

use Factory\Canvas\CanvasInterface;
use Factory\Point\Point;

class Ellipse extends Shape
{
    /** @var Point */
    private $center;
    /** @var int */
    private $verticalRadius;
    /** @var int */
    private $horizontalRadius;

    public function __construct(string $color, Point $center, int $verticalRadius, int $horizontalRadius)
    {
        parent::__construct($color);

        $this->center = $center;
        $this->verticalRadius = $verticalRadius;
        $this->horizontalRadius = $horizontalRadius;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->drawEllipse($this->center, $this->horizontalRadius * 2, $this->verticalRadius * 2);
    }
}