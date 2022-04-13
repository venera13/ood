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
    /** @var bool */
    private $removed;

    public function __construct(string $path, int $width, int $height, ?bool $removed = false)
    {
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
        $this->removed = $removed;
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

    /**
     * @return bool
     */
    public function isRemoved(): ?bool
    {
        return $this->removed;
    }

    /**
     * @param bool $removed
     */
    public function setRemoved(?bool $removed): void
    {
        $this->removed = $removed;
    }

    public function resize(int $width, int $height): void
    {
        $this->width = $width;
        $this->height = $height;
    }
}