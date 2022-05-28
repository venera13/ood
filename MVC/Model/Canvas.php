<?php
declare(strict_types=1);

namespace MVC\Model;

use GdImage;

class Canvas
{
    /** @var int */
    private $maxX;
    /** @var int */
    private $maxY;
    /** @var int */
    private $x0;
    /** @var int */
    private $y0;
    /** @var int */
    private $black;
    /** @var int */
    private $grey;
    /** @var GdImage */
    private $im;

    public function __construct()
    {
        $this->im = imagecreatetruecolor(580, 320);
    }

    public function drawChart(array $data): void
    {
        $white = imageColorAllocate($this->im, 255, 255, 255);

        imagefilledrectangle($this->im, 0, 0, 580, 500, $white);

        $this->black = imageColorAllocate($this->im, 0, 0, 0);
        $blue = imageColorAllocate($this->im, 0, 0, 255);
        $this->grey = imageColorAllocate($this->im, 221, 221, 221);

        $imWidth = 580;
        $imHeignt = 320;
        $this->x0 = 25;
        $this->y0 = 20;
        $this->maxX = $imWidth-$this->x0;
        $this->maxY = $imHeignt-$this->y0;

        $xStep = 60;
        $yStep = 15;
        $this->drawGrid($xStep, $yStep, 0.5);
        $this->drawAxises();
        $this->drawData($data['x'], $data['y'], count($data['x']), $blue);
        Header("Content-Type: image/png");
        ImagePNG($this->im);
        imagedestroy($this->im);
    }

    private function drawAxises(): void
    {
        imageline($this->im, $this->x0, $this->maxY/2, $this->maxX, $this->maxY/2, $this->black);
        imageline($this->im, $this->x0, $this->y0, $this->x0, $this->maxY, $this->black);
        $xArrow[0] = $this->maxX-6; $xArrow[1] = $this->maxY/2-2;
        $xArrow[2] = $this->maxX; $xArrow[3] = $this->maxY/2;
        $xArrow[4] = $this->maxX-6; $xArrow[5] = $this->maxY/2+2;
        imagefilledpolygon($this->im, $xArrow, 3, $this->black);
        $yArrow[0] = $this->x0-2; $yArrow[1] = $this->y0+6;
        $yArrow[2] = $this->x0; $yArrow[3] = $this->y0;
        $yArrow[4] = $this->x0+2; $yArrow[5] = $this->y0+6;
        imagefilledpolygon($this->im, $yArrow, 3, $this->black);
    }

    private function drawGrid($xStep, $yStep, $xCoef): void
    {
        $xSteps=($this->maxX-$this->x0) / $xStep-1;
        for ($i = 1; $i < $xSteps + 1; $i++)
        {
            imageline($this->im, intval($this->x0+$xStep*$i), $this->y0, $this->x0 + $xStep*$i,$this->maxY - 1, $this->grey);
            imagestring($this->im, 1, ($this->x0+$xStep*$i) - 1, $this->maxY + 2, strval($i * $xCoef), $this->black);
        }
        for ($i = -8; $i < 9; $i += 2)
        {
            imageline($this->im, $this->x0 + 1, $this->maxY/2 - $yStep * $i, $this->maxX, $this->maxY/2 - $yStep * $i, $this->grey);
            imagestring($this->im, 1, 0, ($this->maxY/2 - ($yStep * $i))-3, strval($i), $this->black);
        }
    }

    private function drawData($data_x, $data_y, $pointsCount, $color): void
    {

        for ($i = 1; $i < $pointsCount; $i++)
        {
            imageline($this->im, intval($this->x0 + $data_x[$i-1] * 120), intval((abs(5 - $data_y[$i-1] + 3)) * 15 + 30),
                intval($this->x0 + $data_x[$i] * 120), intval((abs(5 - $data_y[$i] + 3)) * 15 + 30), $color);
        }
    }
}