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
    private $l_grey;
    /** @var GdImage */
    private $im;
    /** @var int */
    private $scaleX;
    /** @var int */
    private $scaleY;

    public function __construct()
    {
        $this->image = imagecreatetruecolor(200, 200);
    }

    public function drawChart(): void
    {
        $this->im = imagecreatetruecolor(580, 400);
        $white = ImageColorAllocate ($this->im, 255, 255, 255);

        imagefilledrectangle($this->im, 0, 0, 580, 500, $white);

        $this->black = ImageColorAllocate ($this->im, 0, 0, 0);
        $red = ImageColorAllocate ($this->im, 255, 0, 0);
        $blue = ImageColorAllocate ($this->im, 0, 0, 255);
        $this->l_grey = ImageColorAllocate ($this->im, 221, 221, 221);
        $this->drawAxises(580,400);
        $x1[0]=1; $y1[0]=1;
        $x1[1]=2; $y1[1]=4;
        $x1[2]=3; $y1[2]=8;
        $x1[3]=4; $y1[3]=16;
        $x2[0]=1.5; $y2[0]=1;
        $x2[1]=2.5; $y2[1]=4;
        $x2[2]=3.5; $y2[2]=8;
        $x2[3]=4.5; $y2[3]=16;
        $x = array_merge($x1,$x2);
        $y = array_merge($y1,$y2);
        $this->maxXVal = max($x);
        $this->maxYVal = max($y);
        $this->scaleX=($this->maxX - $this->x0) / $this->maxXVal;
        $this->scaleY=($this->maxY - $this->y0) / $this->maxYVal;
        $xStep = 30;
        $yStep = 30;
        $this->drawGrid($xStep, $yStep, round($xStep/$this->scaleX,1), round($yStep/$this->scaleY,1), true);
        $this->drawData($x1, $y1, 4, $red);
        $this->drawData($x2, $y2, 4, $blue);
        Header("Content-Type: image/png");
        ImagePNG($this->im);
        imagedestroy($this->im);
    }

    private function drawAxises($imWidth,$imHeignt): void
    {
        $this->x0 = 25;
        $this->y0 = 20;
        $this->maxX = $imWidth-$this->x0;
        $this->maxY = $imHeignt-$this->y0;
        imageline($this->im, $this->x0, $this->maxY, $this->maxX, $this->maxY, $this->black);
        imageline($this->im, $this->x0, $this->y0, $this->x0, $this->maxY, $this->black);
        $xArrow[0] = $this->maxX-6; $xArrow[1] = $this->maxY-2;
        $xArrow[2] = $this->maxX; $xArrow[3] = $this->maxY;
        $xArrow[4] = $this->maxX-6; $xArrow[5] = $this->maxY+2;
        imagefilledpolygon($this->im, $xArrow, 3, $this->black);
        $yArrow[0] = $this->x0-2; $yArrow[1] = $this->y0+6;
        $yArrow[2] = $this->x0; $yArrow[3] = $this->y0;
        $yArrow[4] = $this->x0+2; $yArrow[5] = $this->y0+6;
        imagefilledpolygon($this->im, $yArrow, 3, $this->black);
    }

    private function drawGrid($xStep, $yStep, $xCoef, $yCoef): void
    {
        $xSteps=($this->maxX-$this->x0) / $xStep-1;
        $ySteps=($this->maxY-$this->y0) / $yStep-1;
        for ($i = 1; $i < $xSteps + 1; $i++)
        {
            imageline($this->im, intval($this->x0+$xStep*$i), $this->y0, $this->x0 + $xStep*$i,$this->maxY - 1, $this->l_grey);
            imagestring($this->im, 1, ($this->x0+$xStep*$i) - 1, $this->maxY + 2, strval($i * $xCoef), $this->black);
        }
        for ($i=1;$i<$ySteps+1;$i++)
        {
            imageline($this->im, $this->x0+1, $this->maxY-$yStep * $i, $this->maxX, $this->maxY-$yStep * $i, $this->l_grey);
            imagestring($this->im, 1, 0, ($this->maxY-$yStep * $i)-3, strval($i * $yCoef), $this->black);
        }
    }

    private function drawData($data_x, $data_y, $pointsCount, $color): void
    {
        for($i = 1; $i < $pointsCount; $i++)
        {
            imageline($this->im, intval($this->x0 + $data_x[$i-1]*$this->scaleX), intval($this->maxY - $data_y[$i-1] * $this->scaleY),
                intval($this->x0 + $data_x[$i] * $this->scaleX), intval($this->maxY - $data_y[$i] * $this->scaleY), $color);
        }
    }
}