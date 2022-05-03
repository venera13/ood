<?php

namespace Composite\Canvas;

use Composite\Domain\Point\Point;
use Composite\Style\Domain\RGBAColor;

interface CanvasInterface
{
    /**
     * @param RGBAColor $color
     */
    public function setLineColor(RGBAColor $color): void;

    /**
     * @param RGBAColor $color
     */
    public function setFillColor(RGBAColor $color): void;

    /**
     * @param Point $from
     * @param Point $to
     */
    public function drawLine(Point $from, Point $to): void;

    /**
     * @param Point[] $vertexes
     */
    public function fillPolygon(array $vertexes): void;

    /**
     * @param Point $center
     * @param int $width
     * @param int $height
     */
    public function drawEllipse(Point $center, int $width, int $height): void;

    /**
     * @param Point $center
     * @param int $width
     * @param int $height
     */
    public function fillEllipse(Point $center, int $width, int $height): void;
}