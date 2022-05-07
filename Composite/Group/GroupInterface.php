<?php
declare(strict_types=1);

namespace Composite\Group;

use Composite\Shape\ShapeInterface;

interface GroupInterface extends ShapeInterface
{
    /**
     * @return int
     */
    public function getShapesCount(): int;

    /**
     * @param int $index
     * @return ShapeInterface
     */
    public function getShapesAtIndex(int $index): ShapeInterface;

    /**
     * @param ShapeInterface $shape
     * @param int|null $index
     */
    public function insertShape(ShapeInterface $shape, ?int $index = null): void;

    /**
     * @param int $index
     */
    public function removeShapeAtIndex(int $index): void;
}