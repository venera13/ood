<?php

namespace Factory\Factory;

use Factory\Shape\ShapeInterface;

interface ShapeFactoryInterface
{
    public function createShape(string $description): ShapeInterface;
}