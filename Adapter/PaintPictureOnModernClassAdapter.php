<?php
declare(strict_types=1);

namespace Adapter;

use Adapter\GraphicsLib\CanvasInterface;
use Adapter\ModernGraphicsLib\ModernGraphicsRenderer;
use Adapter\ModernGraphicsLib\Point;

class PaintPictureOnModernClassAdapter extends ModernGraphicsRenderer implements CanvasInterface
{
    /** @var Point */
    private $start;

    public function __construct()
    {
        $this->beginDraw();
    }

    public function moveTo(int $x, int $y): void
    {
        $this->start = new Point($x, $y);
    }

    public function lineTo(int $x, int $y): void
    {
        $this->drawLine($this->start, new Point($x, $y));
    }
}