<?php
declare(strict_types=1);

namespace Composite\Shape;

use Composite\Canvas\CanvasInterface;
use Composite\Domain\Point\Point;
use Composite\Shape\Domain\Rect;

class Triangle extends Shape
{
    /** @var Point */
    private $vertex1;
    /** @var Point */
    private $vertex2;
    /** @var Point */
    private $vertex3;

    public function __construct(Point $vertex1, Point $vertex2, Point $vertex3)
    {
        $this->vertex1 = $vertex1;
        $this->vertex2 = $vertex2;
        $this->vertex3 = $vertex3;
    }

    public function draw(CanvasInterface $canvas): void
    {
        if ($this->getFillStyle() && $this->getFillStyle()->isEnabled())
        {
            $canvas->setFillColor($this->getFillStyle()->getColor());
            $canvas->fillPolygon([$this->vertex1, $this->vertex2, $this->vertex3]);
        }

        if ($this->getLineStyle() && $this->getLineStyle()->isEnabled())
        {
            $canvas->setLineColor($this->getLineStyle()->getColor());
            $canvas->drawLine($this->vertex1, $this->vertex2, $this->getLineStyle()->getThick());
            $canvas->drawLine($this->vertex1, $this->vertex3, $this->getLineStyle()->getThick());
            $canvas->drawLine($this->vertex2, $this->vertex3, $this->getLineStyle()->getThick());
        }
    }

    public function getFrame(): Rect
    {
        $minX = min($this->vertex1->getX(), $this->vertex2->getX(), $this->vertex3->getX());
        $minY = min($this->vertex1->getY(), $this->vertex2->getY(), $this->vertex3->getY());
        $maxX = max($this->vertex1->getX(), $this->vertex2->getX(), $this->vertex3->getX());
        $maxY = max($this->vertex1->getY(), $this->vertex2->getY(), $this->vertex3->getY());

        return new Rect(new Point($minX, $minY), $maxX - $minX, $maxY - $minY);
    }

    public function setFrame(Rect $rect): void
    {
        $currentFrame = $this->getFrame();
        $this->vertex1 = $this->updateVertex($rect, $currentFrame, $this->vertex1);
        $this->vertex2 = $this->updateVertex($rect, $currentFrame, $this->vertex2);
        $this->vertex3 = $this->updateVertex($rect, $currentFrame, $this->vertex3);
    }

    private function updateVertex(Rect $rect, Rect $currentFrame, Point $point): Point
    {
        $x = $rect->getLeftTop()->getX() + ($point->getX() - $currentFrame->getLeftTop()->getX()) / $currentFrame->getWidth() * $rect->getWidth();
        $y = $rect->getLeftTop()->getY() + ($point->getY() - $currentFrame->getLeftTop()->getY()) / $currentFrame->getHeight() * $rect->getHeight();

        return new Point($x, $y);
    }
}