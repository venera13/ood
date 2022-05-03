<?php
declare(strict_types=1);

namespace Composite\Shape;

use Composite\Canvas\CanvasInterface;
use Composite\Domain\Point\Point;
use Composite\Shape\Domain\Rect;

class Ellipse extends Shape
{
    /** @var Point */
    private $center;
    /** @var int */
    private $verticalRadius;
    /** @var int */
    private $horizontalRadius;

    public function __construct(Point $center, int $verticalRadius, int $horizontalRadius)
    {
        $this->center = $center;
        $this->verticalRadius = $verticalRadius;
        $this->horizontalRadius = $horizontalRadius;
    }

    public function draw(CanvasInterface $canvas): void
    {
        if ($this->getLineStyle() && $this->getLineStyle()->isEnabled())
        {
            $canvas->setLineColor($this->getLineStyle()->getColor());
            $canvas->drawEllipse($this->center, $this->horizontalRadius * 2, $this->verticalRadius * 2);
        }

        if ($this->getFillStyle() && $this->getFillStyle()->isEnabled())
        {
            $canvas->setFillColor($this->getFillStyle()->getColor());
            $canvas->fillEllipse($this->center, $this->horizontalRadius * 2, $this->verticalRadius * 2);
        }
    }

    public function getFrame(): Rect
    {
        $leftTop = new Point($this->center->getX() - $this->horizontalRadius, $this->center->getY() - $this->verticalRadius);
        return new Rect($leftTop, $this->horizontalRadius * 2, $this->verticalRadius * 2);
    }

    public function setFrame(Rect $rect): void
    {
        $this->center = new Point($rect->getLeftTop()->getX() + $rect->getWidth()/2, $rect->getLeftTop()->getY() + $rect->getHeight()/2);
        $this->horizontalRadius = $rect->getWidth()/2;
        $this->verticalRadius = $rect->getHeight()/2;
    }
}