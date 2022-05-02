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
    /** @var int|null */
    private $color;

    public function __construct(Point $leftTop, int $width, int $height, ?int $color = 0x000000)
    {
        $this->leftTop = $leftTop;
        $this->width = $width;
        $this->height = $height;
        $this->color = $color;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setColor($this->color);

        $canvas->moveTo($this->leftTop->getX() + $this->width, $this->leftTop->getY());
        $canvas->lineTo($this->leftTop->getX(), $this->leftTop->getY());

        $canvas->moveTo($this->leftTop->getX() + $this->width, $this->leftTop->getY() + $this->height);
        $canvas->lineTo($this->leftTop->getX() + $this->width, $this->leftTop->getY());

        $canvas->moveTo($this->leftTop->getX(), $this->leftTop->getY() + $this->height);
        $canvas->lineTo($this->leftTop->getX() + $this->width, $this->leftTop->getY() + $this->height);

        $canvas->moveTo($this->leftTop->getX(), $this->leftTop->getY());
        $canvas->lineTo($this->leftTop->getX(), $this->leftTop->getY() + $this->height);
    }
}