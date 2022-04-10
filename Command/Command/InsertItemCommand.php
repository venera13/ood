<?php
declare(strict_types=1);

namespace Command\Command;

use Command\Data\DocumentItem;

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
            array_splice($this->items, 0, count($this->items) - 1);
        }
        else
        {
            array_splice($this->items, $this->position, 1);
        }
    }
}