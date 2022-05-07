<?php
declare(strict_types=1);

namespace Adapter\ShapeDrawingLib;

use Adapter\GraphicsLib\CanvasInterface;

class Triangle implements CanvasDrawableInterface
{
    /** @var Point */
    private $p1;
    /** @var Point */
    private $p2;
    /** @var Point */
    private $p3;
    /** @var int|null */
    private $color;

    public function __construct(Point $p1, Point $p2, Point $p3, ?int $color = 0x000000)
    {
        $this->p1 = $p1;
        $this->p2 = $p2;
        $this->p3 = $p3;
        $this->color = $color;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->setColor($this->color);

        $canvas->moveTo($this->p2->getX(), $this->p2->getY());
        $canvas->lineTo($this->p1->getX(), $this->p1->getY());
        $canvas->lineTo($this->p2->getX(), $this->p2->getY());
        $canvas->lineTo($this->p3->getX(), $this->p3->getY());
    }
}