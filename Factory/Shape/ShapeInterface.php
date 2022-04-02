<?php

namespace Factory\Shape;

use Factory\Canvas\CanvasInterface;

interface ShapeInterface
{
    public function draw(CanvasInterface $canvas): void;

    public function getColor(): string;
}