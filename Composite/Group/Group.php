<?php
declare(strict_types=1);

namespace Composite\Group;

use Composite\Canvas\CanvasInterface;
use Composite\Shape\Domain\Rect;
use Composite\Shape\Shape;
use Composite\Shape\ShapeInterface;
use Composite\Style\FillStyle;
use Composite\Style\LineStyle;

class Group implements GroupInterface
{
    /** @var ShapeInterface[] */
    private $shapes;

    public function getShapesCount(): int
    {
        // TODO: Implement getShapesCount() method.
    }

    public function getShapesAtIndex(int $index): Shape
    {
        // TODO: Implement getShapesAtIndex() method.
    }

    public function insertShape(Shape $shape, int $index): void
    {
        // TODO: Implement insertShape() method.
    }

    public function removeShapeAtIndex(int $index): void
    {
        // TODO: Implement removeShapeAtIndex() method.
    }

    public function draw(CanvasInterface $canvas): void
    {
        // TODO: Implement draw() method.
    }

    public function getFrame(): Rect
    {
        // TODO: Implement getFrame() method.
    }

    public function setFrame(Rect $rect): void
    {
        // TODO: Implement setFrame() method.
    }

    public function setLineStyle(LineStyle $style): void
    {
        // TODO: Implement setLineStyle() method.
    }

    public function getLineStyle(): ?LineStyle
    {
        // TODO: Implement getLineStyle() method.
    }

    public function setFillStyle(FillStyle $style): void
    {
        // TODO: Implement setFillStyle() method.
    }

    public function getFillStyle(): ?FillStyle
    {
        // TODO: Implement getFillStyle() method.
    }

    public function getGroup(): ?GroupInterface
    {
        // TODO: Implement getGroup() method.
    }
}