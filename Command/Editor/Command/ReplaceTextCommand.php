<?php
declare(strict_types=1);

namespace Command\Command;

use Command\Data\Paragraph\Paragraph;

class ReplaceTextCommand implements CommandInterface
{
    /** @var Paragraph */
    private $paragraph;
    /** @var string */
    private $newText;
    /** @var string */
    private $oldText;

    public function __construct(Paragraph $paragraph, string $newText, string $oldText)
    {
        $this->paragraph = $paragraph;
        $this->newText = $newText;
        $this->oldText = $oldText;
    }

    public function execute(): void
    {
        $this->paragraph->setText($this->newText);
    }

    public function unexecute(): void
    {
        $this->paragraph->setText($this->oldText);
    }
}