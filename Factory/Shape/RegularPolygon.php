<?php
declare(strict_types=1);

namespace Factory\Shape;

use Factory\Canvas\CanvasInterface;
use Factory\Point\Point;

class RegularPolygon extends Shape
{
    /** @var Point */
    private $center;
    /** @var int */
    private $radius;
    /** @var int */
    private $vertexesCount;

    public function __construct(string $color, Point $center, int $radius, int $vertexesCount)
    {
        parent::__construct($color);

        $this->center = $center;
        $this->radius = $radius;
        $this->vertexesCount = $vertexesCount;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $angle = 2 * pi() / $this->vertexesCount;

        $prevPoint = null;

        for ($i = 0; $i < $this->vertexesCount; ++$i)
        {
            $x = $this->center->getX() + $this->radius * sin($i * $angle);
            $y = $this->center->getY() + $this->radius * cos($i * $angle);
            $currentPoint = new Point((int) $x, (int) $y);

            if ($prevPoint !== null)
            {
                $canvas->drawLine($prevPoint, $currentPoint);
            }

            $prevPoint = $currentPoint;
        }
    }
}