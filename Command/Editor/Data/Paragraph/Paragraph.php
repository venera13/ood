<?php
declare(strict_types=1);

namespace Command\Data\Paragraph;

use Command\Command\ReplaceTextCommand;
use Command\History\History;

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

    public function replaceText(History $history, string $text)
    {
        $history->addAndExecuteCommand(new ReplaceTextCommand($this, $text, $this->getText()));
    }
}