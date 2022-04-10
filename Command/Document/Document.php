<?php
declare(strict_types=1);

namespace Command\Document;

use Command\Command\ChangeStringCommand;
use Command\Command\InsertItemCommand;
use Command\Data\DocumentItem;
use Command\Data\Paragraph\Paragraph;
use Command\DocumentExporter\DocumentHtmlExporter;
use Command\Exceptions\InvalidPositionException;
use Command\History\History;

class Document implements DocumentInterface
{
    /** @var History */
    private $history;
    /** @var string */
    private $title = '';
    /** @var DocumentItem[] */
    private $items = [];

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function insertParagraph(string $text, ?int $position = null): void
    {
        if ($position !== null && !$this->isVerifyPosition($position))
        {
            throw new InvalidPositionException();
        }
        $paragraph = new Paragraph();
        $paragraph->setText($text);
        $this->history->addAndExecuteCommand(new InsertItemCommand($this->items, new DocumentItem($paragraph, null), $position));
    }

    public function insertImage(string $path, int $width, int $height, ?int $position = null): void
    {
        // TODO: Implement insertImage() method.
    }

    public function getItemsCount(): int
    {
        return count($this->items);
    }

    public function getItem(int $index): DocumentItem
    {
        return $this->items[$index];
    }

    public function deleteItem(int $index): void
    {
        // TODO: Implement deleteItem() method.
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->history->addAndExecuteCommand(new ChangeStringCommand($this->title, $title));
    }

    public function canUndo(): bool
    {
        return $this->history->canUndo();
    }

    public function undo(): void
    {
        $this->history->undo();
    }

    public function canRedo(): bool
    {
        return $this->history->canRedo();
    }

    public function redo(): void
    {
        $this->history->redo();
    }

    public function save(string $fileName): void
    {
        $htmlExporter = new DocumentHtmlExporter($this);
        $fileContent = $htmlExporter->generate();
        file_put_contents($fileName . '.html', $fileContent);
    }

    private function isVerifyPosition(int $position): bool
    {
        return $position < $this->getItemsCount();
    }
}