<?php

namespace Factory\Canvas;

use Factory\Point\Point;

interface CanvasInterface
{
    public function drawImage(): void;

    public function setColor(string $color): void;

    public function drawLine(Point $from, Point $to): void;

    public function drawEllipse(Point $center, int $verticalRadius, int $horizontalRadius): void;
}