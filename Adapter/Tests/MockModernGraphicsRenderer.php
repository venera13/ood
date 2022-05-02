<?php
declare(strict_types=1);

namespace Adapter\Tests;

use Adapter\ModernGraphicsLib\ModernGraphicsRenderer;
use Adapter\ModernGraphicsLib\Point;
use Adapter\ModernGraphicsLib\RGBAColor;

class MockModernGraphicsRenderer extends ModernGraphicsRenderer
{
    public function drawLine(Point $start, Point $end, RGBAColor $color)
    {
        echo $start->getX() . $start->getY() . $end->getX() . $end->getY();
    }
}