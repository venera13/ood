<?php
declare(strict_types=1);

namespace Adapter\ShapeDrawingLib;

use Adapter\GraphicsLib\CanvasInterface;

class Rectangle implements CanvasDrawableInterface
{
    /** @var Point */
    private $leftTop;
    /** @var int */
    private $width;
    /** @var int */
    private $height;

    public function __construct(Point $leftTop, int $width, int $height)
    {
        $this->leftTop = $leftTop;
        $this->width = $width;
        $this->height = $height;
    }

    public function draw(CanvasInterface $canvas): void
    {
        echo 'Draw rectangle</br>';
    }
}