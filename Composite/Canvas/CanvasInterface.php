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
     * @param int|null $thick
     */
    public function drawLine(Point $from, Point $to, ?int $thick = 1): void;

    /**
     * @param Point[] $vertexes
     */
    public function fillPolygon(array $vertexes): void;

    /**
     * @param Point $center
     * @param float $width
     * @param float $height
     * @param int|null $thick
     */
    public function drawEllipse(Point $center, float $width, float $height, ?int $thick = 1): void;

    /**
     * @param Point $center
     * @param float $width
     * @param float $height
     */
    public function fillEllipse(Point $center, float $width, float $height): void;
}