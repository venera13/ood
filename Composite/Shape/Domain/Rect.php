<?php
declare(strict_types=1);

namespace Composite\Shape\Domain;

use Composite\Domain\Point\Point;

class Rect
{
    /** @var Point */
    private $leftTop;
    /** @var int */
    private $width;
    /** @var int */
    private $height;

    public function __construct(Point $leftTop, int $width, int $height)
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
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }
}