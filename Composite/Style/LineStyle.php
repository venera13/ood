<?php
declare(strict_types=1);

namespace Composite\Style;

use Composite\Style\Domain\RGBAColor;

class LineStyle implements StyleInterface
{
    /** @var RGBAColor */
    private $color;
    /** @var int */
    private $thick = 1;
    /** @var bool */
    private $enable = false;

    public function isEnabled(): bool
    {
        return $this->enable;
    }

    public function enable(bool $enable): void
    {
        $this->enable = $enable;
    }

    public function setColor(RGBAColor $color): void
    {
        $this->color = $color;
    }

    public function getColor(): ?RGBAColor
    {
        return $this->color;
    }

    public function setThick(int $thick): void
    {
        $this->thick = $thick;
    }

    public function getThick(): int
    {
        return $this->thick;
    }
}