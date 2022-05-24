<?php
declare(strict_types=1);

namespace Composite\CompositeStyle;

use Composite\Style\Domain\RGBAColor;
use Composite\Style\FillStyle;
use Composite\Style\StyleInterface;

class CompositeFillStyle implements StyleInterface
{
    /** @var callable */
    private $callable;
    /** @var bool */
    private $enable = false;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function isEnabled(): bool
    {
        return $this->enable;
    }

    public function enable(bool $enable): void
    {
        $this->enable = $enable;
    }

    public function getColor(): ?RGBAColor
    {
        $fillColor = null;

        $callback = function (?FillStyle $fillStyle) use (&$fillColor)
        {
            $shapeFillColor = $fillStyle?->getColor();
            if ($fillColor === null)
            {
                $fillColor = $shapeFillColor;
            }
            elseif ($shapeFillColor !== null)
            {
                $fillColor = $fillColor == $shapeFillColor
                    ? $shapeFillColor
                    : null;
            }
        };
        $callable = $this->callable;
        $callable($callback);

        return $fillColor;
    }

    public function setColor(RGBAColor $color): void
    {
        $callback = function (?FillStyle $fillStyle) use ($color)
        {
            if ($fillStyle === null)
            {
                $fillStyle = new FillStyle();
                $fillStyle->enable(true);
            }
            $fillStyle->setColor($color);
        };

        $callable = $this->callable;
        $callable($callback);
    }
}