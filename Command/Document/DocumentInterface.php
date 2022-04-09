<?php
declare(strict_types=1);

namespace Command\Document;

use Command\Data\ConstDocumentItem;
use Command\Data\DocumentItem;

interface DocumentInterface
{
    public function insertParagraph(string $text, ?int $position = null): void;

    public function insertImage(string $path, int $width, int $height, ?int $position = null): void;

    public function getItemsCount(): int;

    public function getItem(): ConstDocumentItem|DocumentItem;

    public function deleteItem(int $index): void;

    public function getTitle(): string;

    public static function setTitle(string $title): void;

    public function canUndo(): bool;

    public function undo(): bool;

    public function canRedo(): bool;

    public function redo(): bool;

    public function save(): bool;
}