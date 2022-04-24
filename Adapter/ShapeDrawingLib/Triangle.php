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

    public function __construct(Point $p1, Point $p2, Point $p3)
    {
        $this->p1 = $p1;
        $this->p2 = $p2;
        $this->p3 = $p3;
    }

    public function draw(CanvasInterface $canvas): void
    {
        echo 'Draw triangle</br>';
    }
}