<?php
declare(strict_types=1);

namespace Command\Command;

use Command\Data\Image\ImageInterface;

class ResizeImageCommand implements CommandInterface
{
    /** @var ImageInterface */
    private $image;
    /** @var int */
    private $newWidth;
    /** @var int */
    private $newHeight;
    /** @var int */
    private $oldWidth;
    /** @var int */
    private $oldHeight;

    public function __construct(ImageInterface &$image, int $newWidth, int $newHeight, int $oldWidth, int $oldHeight)
    {
        $this->image = &$image;
        $this->newWidth = $newWidth;
        $this->newHeight = $newHeight;
        $this->oldWidth = $oldWidth;
        $this->oldHeight = $oldHeight;
    }

    public function execute(): void
    {
        $this->image->resize($this->newWidth, $this->newHeight);
    }

    public function unexecute(): void
    {
        $this->image->resize($this->oldWidth, $this->oldHeight);
    }

    public function destroy(): void
    {

    }
}