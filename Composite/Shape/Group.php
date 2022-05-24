<?php
declare(strict_types=1);

namespace Composite\Group;

use Composite\Canvas\CanvasInterface;
use Composite\CompositeStyle\CompositeFillStyle;
use Composite\CompositeStyle\CompositeLineStyle;
use Composite\Domain\Point\Point;
use Composite\Exceptions\InvalidArgumentsException;
use Composite\Shape\Domain\Rect;
use Composite\Shape\ShapeInterface;
use Composite\Shape\Style\LineStyleEnumerator;
use Composite\Style\FillStyle;
use Composite\Style\LineStyle;
use Composite\Style\StyleInterface;

class Group implements GroupInterface
{
    /** @var ShapeInterface[] */
    private $shapes = [];
    /** @var CompositeLineStyle */
    private $lineStyle;
    /** @var FillStyle|null */
    private $fillStyle;

    public function __construct()
    {
        $lineStyleEnumerator = function(callable $callback)
        {
            foreach ($this->shapes as $shape)
            {
                $callback($shape->getLineStyle());
            }
        };
        $fillStyleEnumerator = function(callable $callback)
        {
            foreach ($this->shapes as $shape)
            {
                $callback($shape->getFillStyle());
            }
        };
        $this->lineStyle = new CompositeLineStyle($lineStyleEnumerator);
        $this->fillStyle = new CompositeFillStyle($fillStyleEnumerator);
    }

    public function getShapesCount(): int
    {
        return count($this->shapes);
    }

    public function getShapesAtIndex(int $index): ShapeInterface
    {
        if ($index >= $this->getShapesCount())
        {
            throw new InvalidArgumentsException('Invalid index');
        }

        return $this->shapes[$index];
    }

    public function insertShape(ShapeInterface $shape, ?int $index = null): void
    {
        if ($index !== null && $index >= $this->getShapesCount())
        {
            throw new InvalidArgumentsException('Invalid index');
        }
        if ($index === null)
        {
            $this->shapes[] = $shape;
        }
        else
        {
            array_splice($this->shapes, $index, 0, $shape);
        }
    }

    public function removeShapeAtIndex(int $index): void
    {
        if ($index >= $this->getShapesCount())
        {
            throw new InvalidArgumentsException('Invalid index');
        }
        unset($this->shapes[$index]);
        $this->shapes = array_values($this->shapes);
    }

    public function draw(CanvasInterface $canvas): void
    {
        foreach ($this->shapes as $shape)
        {
            $shape->draw($canvas);
        }
    }

    public function getFrame(): Rect
    {
        $minX = null;
        $minY = null;
        $maxX = null;
        $maxY = null;

        foreach ($this->shapes as $shape)
        {
            $shapeFrame = $shape->getFrame();
            if ($minX === null && $minY === null)
            {
                $minX = $shapeFrame->getLeftTop()->getX();
                $minY = $shapeFrame->getLeftTop()->getY();
                $maxX = $shapeFrame->getLeftTop()->getX() + $shapeFrame->getWidth();
                $maxY = $shapeFrame->getLeftTop()->getY() + $shapeFrame->getHeight();
                continue;
            }

            $minX = min($minX, $shapeFrame->getLeftTop()->getX());
            $minY = min($minY, $shapeFrame->getLeftTop()->getY());
            $maxX = max($maxX, $shapeFrame->getLeftTop()->getX() + $shapeFrame->getWidth());
            $maxY = max($maxY, $shapeFrame->getLeftTop()->getY() + $shapeFrame->getHeight());
        }

        return new Rect(new Point($minX, $minY), $maxX - $minX, $maxY - $minY);
    }

    public function setFrame(Rect $rect): void
    {
        $currentGroupFrame = $this->getFrame();

        foreach ($this->shapes as $shape)
        {
            $shapeFrame = $shape->getFrame();
            $newShapeLeftTop = $this->getNewFramePoint($rect, $currentGroupFrame, $shapeFrame->getLeftTop());

            $newShapeWidth = $shapeFrame->getWidth() / $currentGroupFrame->getWidth() * $rect->getWidth();
            $newShapeHeight = $shapeFrame->getHeight() / $currentGroupFrame->getHeight() * $rect->getHeight();

            $newShapeFrame = new Rect($newShapeLeftTop, $newShapeWidth, $newShapeHeight);
            $shape->setFrame($newShapeFrame);
        }
    }

    public function setLineStyle(LineStyle $style): void
    {
        $this->lineStyle->setColor($style->getColor());
    }

    public function getLineStyle(): ?StyleInterface
    {
        return $this->lineStyle;
    }

    public function setFillStyle(FillStyle $style): void
    {
        $this->fillStyle->setColor($style->getColor());
    }

    public function getFillStyle(): ?StyleInterface
    {
        return $this->fillStyle;
    }

    public function getGroup(): ?GroupInterface
    {
        return $this;
    }

    /**
     * @param Rect $rect
     * @param Rect $currentFrame
     * @param Point $point
     * @return Point
     */
    private function getNewFramePoint(Rect $rect, Rect $currentFrame, Point $point): Point
    {
        $x = $rect->getLeftTop()->getX() + ($point->getX() - $currentFrame->getLeftTop()->getX()) / $currentFrame->getWidth() * $rect->getWidth();
        $y = $rect->getLeftTop()->getY() + ($point->getY() - $currentFrame->getLeftTop()->getY()) / $currentFrame->getHeight() * $rect->getHeight();

        return new Point($x, $y);
    }
}