<?php
declare(strict_types=1);

namespace Adapter\GraphicsLib;

class Canvas implements CanvasInterface
{
    public function moveTo(int $x, int $y): void
    {
        echo 'Move to (' . $x . ', ' . $y . ')</br>';
    }

    public function lineTo(int $x, int $y): void
    {
        echo 'Line to (' . $x . ', ' . $y . ')</br>';
    }
}