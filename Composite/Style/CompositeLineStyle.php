<?php
declare(strict_types=1);

namespace Composite\CompositeStyle;

use Composite\Style\Domain\RGBAColor;
use Composite\Style\LineStyle;
use Composite\Style\StyleInterface;

class CompositeLineStyle implements StyleInterface
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
        $lineColor = null;

        $callback = function (?LineStyle $lineStyle) use (&$lineColor)
        {
            $shapeLineColor = $lineStyle?->getColor();
            if ($lineColor === null)
            {
                $lineColor = $shapeLineColor;
            }
            elseif ($shapeLineColor !== null)
            {
                $lineColor = $lineColor == $shapeLineColor
                    ? $shapeLineColor
                    : null;
            }
        };
        $callable = $this->callable;
        $callable($callback);

        return $lineColor;
    }

    public function setColor(RGBAColor $color): void
    {
        $callback = function (?LineStyle $lineStyle) use ($color)
        {
            if ($lineStyle === null)
            {
                $lineStyle = new LineStyle();
                $lineStyle->enable(true);
            }
            $lineStyle->setColor($color);
        };

        $callable = $this->callable;
        $callable($callback);
    }
}