<?php
declare(strict_types=1);

namespace Adapter\GraphicsLib;

interface CanvasInterface
{
    /**
     * @param int $x
     * @param int $y
     */
    public function moveTo(int $x, int $y): void;

    /**
     * @param int $x
     * @param int $y
     */
    public function lineTo(int $x, int $y): void;
}