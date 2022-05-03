<?php
declare(strict_types=1);

namespace Composite\Style;

use Composite\Style\Domain\RGBAColor;

class LineStyle implements StyleInterface
{
    /** @var RGBAColor */
    private $color;
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

    public function getColor(): RGBAColor
    {
        return $this->color;
    }
}