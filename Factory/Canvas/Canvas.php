<?php
declare(strict_types=1);

namespace Factory\Canvas;

use Factory\Color\Color;
use Factory\Point\Point;
use GdImage;

class Canvas implements CanvasInterface
{
    /** @var int */
    private $color;
    /** @var GdImage */
    private $image;

    public function __construct()
    {
        $this->image = imagecreatetruecolor(200, 200);
    }

    public function __destruct()
    {
        $this->drawImage();
    }

    public function setColor(string $color): void
    {
        switch ($color)
        {
            case Color::GREEN:
                $this->color = imagecolorallocate($this->image, 0, 128, 0);
                break;
            case Color::RED:
                $this->color = imagecolorallocate($this->image, 255, 0, 0);
                break;
            case Color::BLUE:
                $this->color = imagecolorallocate($this->image, 0, 0, 255);
                break;
            case Color::YELLOW:
                $this->color = imagecolorallocate($this->image, 255, 255, 0);
                break;
            case Color::PINK:
                $this->color = imagecolorallocate($this->image, 255, 192, 203);
                break;
            case Color::BLACK:
                $this->color = imagecolorallocate($this->image, 0, 0, 0);
                break;
        }
    }

    public function drawLine(Point $from, Point $to): void
    {
        imageline($this->image, $from->getX(), $from->getY(), $to->getX(), $to->getY(), $this->color);
    }

    public function drawEllipse(Point $center, int $verticalRadius, int $horizontalRadius): void
    {
        imageellipse($this->image, $center->getX(), $center->getY(), 2 * $horizontalRadius, 2 * $verticalRadius, $this->color);
    }

    private function drawImage(): void
    {
        header("Content-type: image/png");
        imagepng($this->image);
    }
}