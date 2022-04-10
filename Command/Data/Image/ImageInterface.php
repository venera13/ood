<?php
declare(strict_types=1);

namespace Command\Data\Image;

interface ImageInterface
{
    public function getPath(): string;

    public function getWidth(): string;

    public function getHeight(): string;

    public function resize(int $width, int $height): void;
}