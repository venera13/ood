<?php
declare(strict_types=1);

namespace Command\Data;

use Command\Data\Image\ImageInterface;
use Command\Data\Paragraph\ParagraphInterface;

class DocumentItem
{
    /** @var ParagraphInterface|null */
    private $text;
    /** @var ImageInterface|null */
    private $image;
    /** @var bool */
    private $isDeleted = false;

    public function __construct(?ParagraphInterface $text, ?ImageInterface $image)
    {
        $this->text = $text;
        $this->image = $image;
    }

    /**
     * @return ParagraphInterface|null
     */
    public function getText(): ?ParagraphInterface
    {
        return $this->text;
    }

    /**
     * @return ImageInterface|null
     */
    public function getImage(): ?ImageInterface
    {
        return $this->image;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }
}