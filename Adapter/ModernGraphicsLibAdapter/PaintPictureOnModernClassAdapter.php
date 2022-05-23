<?php
declare(strict_types=1);

namespace Adapter\ModernGraphicsLibAdapter;

use Adapter\GraphicsLib\CanvasInterface;
use Adapter\ModernGraphicsLib\ModernGraphicsRenderer;
use Adapter\ModernGraphicsLib\Point;
use Adapter\ModernGraphicsLib\RGBAColor;
use Adapter\ModernGraphicsLibAdapter\Utils\ColorUtil;

class PaintPictureOnModernClassAdapter extends ModernGraphicsRenderer implements CanvasInterface
{
    /** @var Point */
    private $start;
    /** @var RGBAColor */
    private $color;

    public function __construct()
    {
        $this->beginDraw();
    }

    public function setColor(int $rgbColor): void
    {
        [$r, $g, $b] = ColorUtil::hex2RGB($rgbColor);
        $this->color = new RGBAColor($r/255, $g/255, $b/255, 1);
    }

    public function moveTo(int $x, int $y): void
    {
        $this->start = new Point($x, $y);
    }

    public function lineTo(int $x, int $y): void
    {
        $point = new Point($x, $y);
        $this->drawLine($this->start, $point, $this->color);
        $this->start = $point;
    }
}