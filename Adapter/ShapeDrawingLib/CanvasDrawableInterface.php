<?php
declare(strict_types=1);

namespace Adapter\ShapeDrawingLib;

use Adapter\GraphicsLib\CanvasInterface;

interface CanvasDrawableInterface
{
    public function draw(CanvasInterface $canvas): void;
}