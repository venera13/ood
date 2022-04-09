<?php
declare(strict_types=1);

namespace Command\Document;

use Command\Command\ChangeStringCommand;
use Command\Data\ConstDocumentItem;
use Command\Data\DocumentItem;
use Command\History\History;

class Document implements DocumentInterface
{
    /** @var History */
    private $history;
    /** @var string */
    private $title = '';

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function insertParagraph(string $text, ?int $position = null): void
    {
        // TODO: Implement insertParagraph() method.
    }

    public function insertImage(string $path, int $width, int $height, ?int $position = null): void
    {
        // TODO: Implement insertImage() method.
    }

    public function getItemsCount(): int
    {
        // TODO: Implement getItemsCount() method.
    }

    public function getItem(): ConstDocumentItem|DocumentItem
    {
        // TODO: Implement getItem() method.
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
        $this->title = $title;
        $this->history->addAndExecuteCommand(new ChangeStringCommand($this->getTitle(), $title));
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

    public function save(): bool
    {
        // TODO: Implement save() method.
    }
}