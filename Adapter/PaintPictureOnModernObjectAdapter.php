<?php
declare(strict_types=1);

namespace Adapter;

use Adapter\GraphicsLib\CanvasInterface;
use Adapter\ModernGraphicsLib\ModernGraphicsRenderer;
use Adapter\ModernGraphicsLib\Point;

class PaintPictureOnModernObjectAdapter implements CanvasInterface
{
    /** @var ModernGraphicsRenderer */
    private $modernGraphicsRenderer;
    /** @var Point */
    private $start;

    public function __construct(ModernGraphicsRenderer $modernGraphicsRenderer)
    {
        $this->modernGraphicsRenderer = $modernGraphicsRenderer;

        $this->modernGraphicsRenderer->beginDraw();
    }

    public function moveTo(int $x, int $y): void
    {
        $this->start = new Point($x, $y);
    }

    public function lineTo(int $x, int $y): void
    {
        $this->modernGraphicsRenderer->drawLine($this->start, new Point($x, $y));
    }
}