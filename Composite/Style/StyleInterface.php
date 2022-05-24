<?php
declare(strict_types=1);

namespace Composite\Style;

use Composite\Style\Domain\RGBAColor;

interface StyleInterface
{
    /**
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * @param bool $enable
     */
    public function enable(bool $enable): void;

    /**
     * @param RGBAColor $color
     */
    public function setColor(RGBAColor $color): void;

    /**
     * @return RGBAColor|null
     */
    public function getColor(): ?RGBAColor;
}