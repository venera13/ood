<?php
declare(strict_types=1);

namespace Factory\Shape;

use Factory\Canvas\CanvasInterface;
use Factory\Point\Point;

class Rectangle extends Shape
{
    /** @var Point */
    private $leftTop;
    /** @var Point */
    private $rightBottom;

    /**
     * @param Point $leftTop
     * @param Point $rightBottom
     */
    public function __construct(string $color, Point $leftTop, Point $rightBottom)
    {
        parent::__construct($color);

        $this->leftTop = $leftTop;
        $this->rightBottom = $rightBottom;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $canvas->drawLine($this->leftTop, new Point($this->rightBottom->getX(), $this->leftTop->getY()));
        $canvas->drawLine($this->leftTop, new Point($this->leftTop->getX(), $this->rightBottom->getY()));
        $canvas->drawLine(new Point($this->rightBottom->getX(), $this->leftTop->getY()), $this->rightBottom);
        $canvas->drawLine(new Point($this->leftTop->getX(), $this->rightBottom->getY()), $this->rightBottom);
    }
}