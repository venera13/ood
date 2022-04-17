<?php
declare(strict_types=1);

namespace Command\Command;

use Command\Data\DocumentItem;
use Command\Editor\Utils\FileUtils;

class InsertItemCommand implements CommandInterface
{
    /** @var array */
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
        if ($this->position === null)
        {
            array_splice($this->items, 0, 1);
        }
        else
        {
            array_splice($this->items, $this->position, 1);
        }
    }

    public function destroy(): void
    {
        $image = $this->item->getImage();
        if ($image !== null)
        {
            FileUtils::deleteFile($image->getPath());
        }
    }
}