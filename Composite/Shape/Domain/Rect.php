<?php
declare(strict_types=1);

namespace Composite\Shape\Domain;

use Composite\Domain\Point\Point;

class Rect
{
    /** @var Point */
    private $leftTop;
    /** @var float */
    private $width;
    /** @var float */
    private $height;

    public function __construct(Point $leftTop, float $width, float $height)
    {
        $this->leftTop = $leftTop;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return Point
     */
    public function getLeftTop(): Point
    {
        return $this->leftTop;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }
}