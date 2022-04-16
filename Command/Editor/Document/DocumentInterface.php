<?php
declare(strict_types=1);

namespace Command\Document;

use Command\Data\DocumentItem;

interface DocumentInterface
{
    public function insertParagraph(string $text, ?int $position = null): void;

    public function insertImage(string $path, int $width, int $height, ?int $position = null): void;

    public function getItemsCount(): int;

    public function getItem(int $index): DocumentItem;

    public function deleteItem(int $index): void;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function canUndo(): bool;

    public function undo(): void;

    public function canRedo(): bool;

    public function redo(): void;

    public function save(string $fileName): void;
}