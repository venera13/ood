<?php
declare(strict_types=1);

namespace Command\Data\Image;

class Image implements ImageInterface
{
    /** @var string */
    private $path;
    /** @var int */
    private $width;
    /** @var int */
    private $height;

    public function __construct(string $path, int $width, int $height)
    {
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    public function resize(int $width, int $height): void
    {
        $this->width = $width;
        $this->height = $height;
    }
}