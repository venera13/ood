<?php
declare(strict_types=1);

namespace Adapter\ModernGraphicsLibAdapter;

use Adapter\GraphicsLib\CanvasInterface;
use Adapter\ModernGraphicsLib\ModernGraphicsRenderer;
use Adapter\ModernGraphicsLib\Point;
use Adapter\ModernGraphicsLib\RGBAColor;
use Adapter\ModernGraphicsLibAdapter\Utils\ColorUtil;

class PaintPictureOnModernObjectAdapter implements CanvasInterface
{
    /** @var ModernGraphicsRenderer */
    private $modernGraphicsRenderer;
    /** @var Point */
    private $start;
    /** @var RGBAColor */
    private $color;

    public function __construct(ModernGraphicsRenderer $modernGraphicsRenderer)
    {
        $this->modernGraphicsRenderer = $modernGraphicsRenderer;

        $this->modernGraphicsRenderer->beginDraw(); //не вызывать в конструкторе
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
        $this->modernGraphicsRenderer->drawLine($this->start, new Point($x, $y), $this->color);
        //обновлять стартовую точку
    }
}