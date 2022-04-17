<?php
declare(strict_types=1);

namespace Command\Command;

use Command\Data\DocumentItem;
use Command\Editor\Utils\FileUtils;

class InsertItemCommand implements CommandInterface
{
    /** @var DocumentItem[] */
    private $items;
    /** @var DocumentItem */
    private $item;
    /** @var int|null */
    private $position;

    public function __construct(array &$items, DocumentItem $item, ?int $position)
    {
        $this->items = &$items;
        $this->item = $item;
        $this->position = $position;
    }

    public function execute(): void
    {
        $this->item->setIsDeleted(false);
        if ($this->position === null)
        {
            $this->items[] = $this->item;
        }
        else
        {
            array_splice($this->items, $this->position, 0, [$this->item]);
        }
    }

    public function unexecute(): void
    {
        $this->item->setIsDeleted(true);
        if ($this->position === null)
        {
            array_splice($this->items, count($this->items) - 1, 1);
        }
        else
        {
            array_splice($this->items, $this->position, 1);
        }
    }

    public function destroy(): void
    {
        $image = $this->item->getImage();
        if ($this->item->isDeleted() && $image !== null)
        {
            FileUtils::deleteFile($image->getPath());
        }
    }
}