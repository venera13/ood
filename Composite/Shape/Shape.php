<?php
declare(strict_types=1);

namespace Composite\Shape;

use Composite\Group\GroupInterface;
use Composite\Style\StyleInterface;

abstract class Shape implements ShapeInterface
{
    /** @var StyleInterface */
    private $lineStyle;
    /** @var StyleInterface */
    private $fillStyle;

    public function setLineStyle(StyleInterface $style): void
    {
        $this->lineStyle = $style;
    }

    public function getLineStyle(): ?StyleInterface
    {
        return $this->lineStyle;
    }

    public function setFillStyle(StyleInterface $style): void
    {
        $this->fillStyle = $style;
    }

    public function getFillStyle(): ?StyleInterface
    {
        return $this->fillStyle;
    }

    public function getGroup(): ?GroupInterface
    {
        return null;
    }
}