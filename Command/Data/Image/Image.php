<?php
declare(strict_types=1);

namespace Command\Data\Image;

class Image implements ImageInterface
{
    /** @var string */
    private $path;
    /** @var string */
    private $width;
    /** @var string */
    private $height;

    public function __construct(string $path, string $width, string $height)
    {
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function resize(int $width, int $height): void
    {
        $this->width = $width;
        $this->height = $height;
    }
}