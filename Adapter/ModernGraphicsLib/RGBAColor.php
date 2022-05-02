<?php
declare(strict_types=1);

namespace Adapter\ModernGraphicsLib;

class RGBAColor
{
    /** @var float */
    private $r;
    /** @var float */
    private $g;
    /** @var float */
    private $b;
    /** @var float */
    private $a;

    public function __construct(float $r, float $g, float $b, float $a)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }

    /**
     * @return float
     */
    public function getR(): float
    {
        return $this->r;
    }

    /**
     * @return float
     */
    public function getG(): float
    {
        return $this->g;
    }

    /**
     * @return float
     */
    public function getB(): float
    {
        return $this->b;
    }

    /**
     * @return float
     */
    public function getA(): float
    {
        return $this->a;
    }
}