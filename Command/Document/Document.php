<?php
declare(strict_types=1);

namespace Command\Document;

use Command\Data\ConstDocumentItem;
use Command\Data\DocumentItem;

class Document implements DocumentInterface
{
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
        // TODO: Implement getTitle() method.
    }

    public static function setTitle(string $title): void
    {
        // TODO: Implement setTitle() method.
    }

    public function canUndo(): bool
    {
        // TODO: Implement canUndo() method.
    }

    public function undo(): bool
    {
        // TODO: Implement undo() method.
    }

    public function canRedo(): bool
    {
        // TODO: Implement canRedo() method.
    }

    public function redo(): bool
    {
        // TODO: Implement redo() method.
    }

    public function save(): bool
    {
        // TODO: Implement save() method.
    }
}