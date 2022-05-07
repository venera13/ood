<?php
declare(strict_types=1);

namespace Command\Data\Paragraph;

use Command\Command\ChangeStringCommand;
use Command\History\History;

class Paragraph implements ParagraphInterface
{
    /** @var string */
    private $text = '';
    /** @var History */
    private $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->history->addAndExecuteCommand(new ChangeStringCommand($this->text, $text));
    }
}