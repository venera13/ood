<?php
declare(strict_types=1);

namespace Composite\Domain\Point;

class Point
{
    /** @var float */
    private $x;
    /** @var float */
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }
}