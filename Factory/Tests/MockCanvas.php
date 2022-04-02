<?php
declare(strict_types=1);

namespace Factory\Tests;

use Factory\Canvas\CanvasInterface;
use Factory\Point\Point;

class MockCanvas implements CanvasInterface
{
    /** @var int */
    private $color;

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function drawLine(Point $from, Point $to): void
    {
        echo('line');
    }

    public function drawEllipse(Point $center, int $verticalRadius, int $horizontalRadius): void
    {
        echo('ellipse');
    }
}