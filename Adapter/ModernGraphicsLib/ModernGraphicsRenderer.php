<?php
declare(strict_types=1);

namespace Adapter\ModernGraphicsLib;

use Adapter\ModernGraphicsLib\Exceptions\LogicException;

class ModernGraphicsRenderer
{
    /** @var bool */
    private $drawing = false;

    public function __destruct()
    {
        $this->endDraw();
    }

    public function beginDraw(): void
    {
        if ($this->drawing)
        {
            throw new LogicException('Drawing has already begun');
        }

        echo '<draw></br>';

        $this->drawing = true;
    }

    public function drawLine(Point $start, Point $end, RGBAColor $color)
    {
        if (!$this->drawing)
        {
            throw new LogicException('DrawLine is allowed between BeginDraw()/EndDraw() only');
        }

        echo 'Line fromX="' . $start->getX()
            . ' fromY=' . $start->getY()
            . ' toX=' . $end->getX()
            . ' toY=' . $end->getY()
            . ' <\color r="' . $color->getR() . '" g="'. $color->getG() . '" b="'. $color->getB() . '" a="'. $color->getA() . '>"'
            . '</br>';
    }

    private function endDraw(): void
    {
        if (!$this->drawing)
        {
            throw new LogicException('Drawing has not been started');
        }

        echo '</draw></br>';

        $this->drawing = false;
    }
}