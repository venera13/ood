<?php
declare(strict_types=1);

namespace Composite\Shape;

use Composite\Group\GroupInterface;
use Composite\Style\FillStyle;
use Composite\Style\LineStyle;

abstract class Shape implements ShapeInterface
{
    /** @var LineStyle|null */
    private $lineStyle;
    /** @var FillStyle|null */
    private $fillStyle;

    public function setLineStyle(LineStyle $style): void
    {
        $this->lineStyle = $style;
    }

    public function getLineStyle(): ?LineStyle
    {
        return $this->lineStyle;
    }

    public function setFillStyle(FillStyle $style): void
    {
        $this->fillStyle = $style;
    }

    public function getFillStyle(): ?FillStyle
    {
        return $this->fillStyle;
    }

    public function getGroup(): ?GroupInterface
    {
        return null;
    }
}