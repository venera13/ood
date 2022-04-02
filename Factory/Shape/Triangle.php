<?php
declare(strict_types=1);

namespace Factory\Shape;

use Factory\Canvas\CanvasInterface;
use Factory\Point\Point;

class Triangle extends Shape
{
    /** @var Point */
    private $vertex1;
    /** @var Point */
    private $vertex2;
    /** @var Point */
    private $vertex3;

    public function __construct(string $color, Point $vertex1, Point $vertex2, Point $vertex3)
    {
        parent::__construct($color);

        $this->vertex1 = $vertex1;
        $this->vertex2 = $vertex2;
        $this->vertex3 = $vertex3;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->drawLine($this->vertex1, $this->vertex2);
        $canvas->drawLine($this->vertex1, $this->vertex3);
        $canvas->drawLine($this->vertex2, $this->vertex3);
    }
}