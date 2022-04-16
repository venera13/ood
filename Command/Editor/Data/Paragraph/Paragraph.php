<?php
declare(strict_types=1);

namespace Command\Data\Paragraph;

class Paragraph implements ParagraphInterface
{
    /** @var string */
    private $text;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}