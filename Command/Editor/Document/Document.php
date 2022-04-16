<?php
declare(strict_types=1);

namespace Command\Document;

use Command\Command\ChangeStringCommand;
use Command\Command\InsertItemCommand;
use Command\Data\DocumentItem;
use Command\Data\Image\Image;
use Command\Data\Paragraph\Paragraph;
use Command\DocumentExporter\DocumentHtmlExporter;
use Command\Exceptions\CopyFileException;
use Command\Exceptions\InvalidPositionException;
use Command\History\History;
use RuntimeException;

class Document implements DocumentInterface
{
    const DIRECTORY_NAME = 'images';

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
        Document::createDirectory(self::DIRECTORY_NAME);

        $file = $this->createFile($path, self::DIRECTORY_NAME);

        $image = new Image($file, $width, $height);
        $this->history->addAndExecuteCommand(new InsertItemCommand($this->items, new DocumentItem(null, $image), $position));
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
        unset($this->items[$index]);
        $this->items = array_values($this->items);
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

    private static function createDirectory(string $directoryName): void
    {
        if (!file_exists($directoryName))
        {
            mkdir($directoryName);
        }
    }

    private static function createFile(string $file, string $directory): string
    {
        $newFile = $directory . '/' . Document::generateFileName();
        try
        {
            copy($file, $newFile);
            return $newFile;
        }
        catch (RuntimeException $exception)
        {
            throw new CopyFileException();
        }
    }

    private static function generateFileName(): string
    {
        return substr(md5((string)time()), 0, 16);
    }
}