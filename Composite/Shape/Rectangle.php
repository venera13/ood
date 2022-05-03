<?php
declare(strict_types=1);

namespace Composite\Shape;

use Composite\Canvas\CanvasInterface;
use Composite\Domain\Point\Point;
use Composite\Shape\Domain\Rect;

class Rectangle extends Shape
{
    /** @var Point */
    private $leftTop;
    /** @var Point */
    private $rightBottom;

    public function __construct(Point $leftTop, Point $rightBottom)
    {
        $this->leftTop = $leftTop;
        $this->rightBottom = $rightBottom;
    }

    public function draw(CanvasInterface $canvas): void
    {
        if ($this->getLineStyle() && $this->getLineStyle()->isEnabled())
        {
            $canvas->setLineColor($this->getLineStyle()->getColor());
            $canvas->drawLine($this->leftTop, new Point($this->rightBottom->getX(), $this->leftTop->getY()));
            $canvas->drawLine($this->leftTop, new Point($this->leftTop->getX(), $this->rightBottom->getY()));
            $canvas->drawLine(new Point($this->rightBottom->getX(), $this->leftTop->getY()), $this->rightBottom);
            $canvas->drawLine(new Point($this->leftTop->getX(), $this->rightBottom->getY()), $this->rightBottom);
        }

        if ($this->getFillStyle() && $this->getFillStyle()->isEnabled())
        {
            $canvas->setFillColor($this->getFillStyle()->getColor());
            $rightTop = new Point($this->rightBottom->getX(), $this->leftTop->getY());
            $leftBottom = new Point($this->leftTop->getX(), $this->rightBottom->getY());
            $canvas->fillPolygon([$this->leftTop, $rightTop, $this->rightBottom, $leftBottom]);
        }
    }

    public function getFrame(): Rect
    {
        return new Rect($this->leftTop, $this->rightBottom->getX() - $this->leftTop->getX(), $this->rightBottom->getY() - $this->leftTop->getY());
    }

    public function setFrame(Rect $rect): void
    {
        $this->leftTop = $rect->getLeftTop();
        $this->rightBottom = new Point($rect->getLeftTop()->getX() + $rect->getWidth(), $rect->getLeftTop()->getY() + $rect->getHeight());
    }
}