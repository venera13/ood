<?php
declare(strict_types=1);

namespace Command\Command;

use Command\Data\DocumentItem;
use Command\Editor\Utils\FileUtils;

class DeleteItemCommand implements CommandInterface
{
    /** @var DocumentItem[] */
    private $items = [];
    /** @var int */
    private $index;
    /** @var DocumentItem */
    private $item;

    public function __construct(array &$items, int $index)
    {
        $this->items = &$items;
        $this->index = $index;
        $this->item = $this->items[$this->index];
    }

    public function execute(): void
    {
        unset($this->items[$this->index]);
        $this->items = array_values($this->items);
        $this->item->setIsDeleted(true);
    }

    public function unexecute(): void
    {
        array_splice($this->items, $this->index, 0, $this->item);
        $this->item->setIsDeleted(false);
    }

    public function destroy(): void
    {
        if ($this->item->isDeleted() && $this->item->getImage() !== null)
        {
            FileUtils::deleteFile($this->item->getImage()->getPath());
        }
    }
}