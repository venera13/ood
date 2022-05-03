<?php
declare(strict_types=1);

namespace Composite\Group;

use Composite\Shape\Shape;
use Composite\Shape\ShapeInterface;

interface GroupInterface extends ShapeInterface
{
    /**
     * @return int
     */
    public function getShapesCount(): int;

    /**
     * @param int $index
     * @return Shape
     */
    public function getShapesAtIndex(int $index): Shape;

    /**
     * @param Shape $shape
     * @param int $index
     */
    public function insertShape(Shape $shape, int $index): void;

    /**
     * @param int $index
     */
    public function removeShapeAtIndex(int $index): void;
}