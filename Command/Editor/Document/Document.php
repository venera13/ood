<?php
declare(strict_types=1);

namespace Command\Document;

use Command\Command\ChangeStringCommand;
use Command\Command\DeleteItemCommand;
use Command\Command\InsertItemCommand;
use Command\Command\ResizeImageCommand;
use Command\Data\DocumentItem;
use Command\Data\Image\Image;
use Command\Data\Paragraph\Paragraph;
use Command\DocumentExporter\DocumentHtmlExporter;
use Command\Editor\Utils\FileUtils;
use Command\Exceptions\CopyFileException;
use Command\Exceptions\InvalidPositionException;
use Command\History\History;
use RuntimeException;

class Document implements DocumentInterface
{
    const DIRECTORY_NAME = 'images';
    const MAX_IMAGE_SIZE = '10000';

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
        if ($width > self::MAX_IMAGE_SIZE || $height > self::MAX_IMAGE_SIZE)
        {
            throw new InvalidPositionException();
        }

        FileUtils::createDirectory(self::DIRECTORY_NAME);

        $file = FileUtils::createFile($path, self::DIRECTORY_NAME);

        $image = new Image($file, $width, $height);
        $this->history->addAndExecuteCommand(new InsertItemCommand($this->items, new DocumentItem(null, $image), $position));
    }

    public function resizeImage(int $width, int $height, int $position): void
    {
        if ($width > self::MAX_IMAGE_SIZE || $height > self::MAX_IMAGE_SIZE)
        {
            throw new InvalidPositionException();
        }

        try
        {
            $image = $this->getItem($position)->getImage();
        }
        catch (RuntimeException)
        {
            throw new InvalidPositionException();
        }
        if ($image === null)
        {
            throw new InvalidPositionException();
        }

        $this->history->addAndExecuteCommand(new ResizeImageCommand($image, $width, $height, $image->getWidth(), $image->getHeight()));
    }

    public function getItemsCount(): int
    {
        return count($this->items);
    }

    public function getItem(int $index): DocumentItem
    {
        if (!isset($this->items[$index]))
        {
            throw new InvalidPositionException();
        }
        return $this->items[$index];
    }

    public function deleteItem(int $index): void
    {
        if ($index >= $this->getItemsCount())
        {
            throw new InvalidPositionException();
        }
        $this->history->addAndExecuteCommand(new DeleteItemCommand($this->items, $index));
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

        $this->history->clear();
    }

    private function isVerifyPosition(int $position): bool
    {
        return $position < $this->getItemsCount();
    }
}