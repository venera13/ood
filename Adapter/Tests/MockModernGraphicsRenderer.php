<?php
declare(strict_types=1);

namespace Adapter\Tests;

use Adapter\ModernGraphicsLib\Exceptions\LogicException;
use Adapter\ModernGraphicsLib\ModernGraphicsRenderer;
use Adapter\ModernGraphicsLib\Point;

class MockModernGraphicsRenderer extends ModernGraphicsRenderer
{
    public function drawLine(Point $start, Point $end)
    {
        echo $start->getX() . $start->getY() . $end->getX() . $end->getY();
    }
}