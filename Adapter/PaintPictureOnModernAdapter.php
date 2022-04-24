<?php
declare(strict_types=1);

namespace Adapter;

use Adapter\GraphicsLib\CanvasInterface;
use Adapter\ModernGraphicsLib\ModernGraphicsRenderer;
use Adapter\ModernGraphicsLib\Point;

class PaintPictureOnModernAdapter implements CanvasInterface
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
        print_r('123');
        $this->modernGraphicsRenderer->drawLine($this->start, new Point($x, $y));
    }
}