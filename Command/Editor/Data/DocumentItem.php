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
}