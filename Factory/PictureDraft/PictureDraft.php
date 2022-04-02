<?php
declare(strict_types=1);

namespace Factory\PictureDraft;

use Factory\Shape\ShapeInterface;

class PictureDraft
{
    /** @var ShapeInterface[] */
    private $shapes;

    public function __construct(array $shapes)
    {
        $this->shapes = $shapes;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return count($this->shapes);
    }

    /**
     * @param int $index
     * @return ShapeInterface|null
     */
    public function getShape(int $index): ?ShapeInterface
    {
        return $this->shapes[$index] ?? null;
    }
}