<?php
declare(strict_types=1);

namespace Composite\Canvas;

use Composite\Domain\Point\Point;
use Composite\Style\Domain\RGBAColor;
use GdImage;

class Canvas implements CanvasInterface
{
    /** @var int */
    private $lineColor;
    /** @var int */
    private $fillColor;
    /** @var GdImage */
    private $image;

    public function __construct()
    {
        $this->image = imagecreatetruecolor(1600, 1200);
    }

    public function setLineColor(RGBAColor $color): void
    {
        $this->lineColor = imagecolorallocate($this->image, (int)$color->getR(), (int)$color->getG(), (int)$color->getB());
    }

    public function setFillColor(RGBAColor $color): void
    {
        $this->fillColor = imagecolorallocate($this->image, (int)$color->getR(), (int)$color->getG(), (int)$color->getB());
    }

    public function drawLine(Point $from, Point $to, ?int $thick = 1): void
    {
        imagesetthickness($this->image, $thick);
        imageline($this->image, $from->getX(), $from->getY(), $to->getX(), $to->getY(), $this->lineColor);
    }

    public function drawEllipse(Point $center, int $width, int $height, ?int $thick = 1): void
    {
        imagesetthickness($this->image, $thick);
        imageellipse($this->image, $center->getX(), $center->getY(), $width, $height, $this->lineColor);
    }

    public function fillPolygon(array $vertexes): void
    {
        $points = [];
        foreach ($vertexes as $vertex)
        {
            $points[] = $vertex->getX();
            $points[] = $vertex->getY();
        }
        imagefilledpolygon($this->image, $points, count($vertexes), $this->fillColor);
    }

    public function fillEllipse(Point $center, int $width, int $height): void
    {
        imagefilledellipse($this->image, $center->getX(), $center->getY(), $width, $height, $this->fillColor);
    }

    public function drawImage(): void
    {
        header("Content-type: image/png");
        imagepng($this->image);
    }
}