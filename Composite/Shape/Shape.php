<?php
declare(strict_types=1);

namespace Composite\Shape;

use Composite\Group\GroupInterface;
use Composite\Style\FillStyle;
use Composite\Style\LineStyle;
use Composite\Style\StyleInterface;

abstract class Shape implements ShapeInterface
{
    /** @var StyleInterface|null */
    private $lineStyle;
    /** @var StyleInterface|null */
    private $fillStyle;

    public function setLineStyle(LineStyle $style): void
    {
        $this->lineStyle = $style;
    }

    public function getLineStyle(): ?StyleInterface
    {
        return $this->lineStyle;
    }

    public function setFillStyle(FillStyle $style): void
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