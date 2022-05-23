<?php
declare(strict_types=1);

namespace Command\Data\Paragraph;

interface ParagraphInterface
{
    public function getText(): string;

    public function setText(callable $command): void;
}