<?php
declare(strict_types=1);

namespace Factory\Canvas;

use Factory\Point\Point;

class Canvas implements CanvasInterface
{
    /** @var string */
    private $color;

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function drawLine(Point $from, Point $to): void
    {
        print_r('Draw line from (' . $from->getX() . ';' . $from->getY() . '), to (' . $to->getX() . ';' . $to->getY() . '). Color - ' . $this->color . '</br>');
    }

    public function drawEllipse(Point $center, int $verticalRadius, int $horizontalRadius): void
    {
        print_r('Draw ellipse: center (' . $center->getX() . ';' . $center->getY() . '). Vertical radius - ' . $verticalRadius . ', horizontal radius - ' . $horizontalRadius . '. Color - ' . $this->color . '</br>');
    }
}