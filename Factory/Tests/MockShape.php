<?php
declare(strict_types=1);

namespace Factory\Tests;

use Factory\Canvas\CanvasInterface;
use Factory\Point\Point;
use Factory\Shape\Shape;

class MockShape extends Shape
{
    public function draw(CanvasInterface $canvas): void
    {
        $canvas->drawLine(new Point(0, 0), new Point(0, 0));
        $canvas->drawEllipse(new Point(0, 0), 0, 0);
    }
}