<?php
declare(strict_types=1);

namespace Adapter\ShapeDrawingLib;

use Adapter\GraphicsLib\CanvasInterface;

class CanvasPainter
{
    /** @var CanvasInterface */
    private $canvas;

    public function __construct(CanvasInterface $canvas)
    {
        $this->canvas = $canvas;
    }

    public function draw(CanvasDrawableInterface $drawable): void
    {
        echo 'Canvas painter draw</br>';
        $drawable->draw($this->canvas);
    }
}