<?php
declare(strict_types=1);

namespace Command\Data\Paragraph;

use Command\History\History;

interface ParagraphInterface
{
    public function getText(): string;

    public function setText(string $text): void;

    public function replaceText(History $history, string $text);
}