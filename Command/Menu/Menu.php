<?php
declare(strict_types=1);

namespace Command\Menu;

use Command\Data\Item;
use Command\Exceptions\InvalidCommandException;

class Menu
{
    /** @var Item[] */
    private $items;
    /** @var bool */
    private $exit;

    public function __construct()
    {
        $this->exit = false;
    }

    public function addItem(string $shortcut, string $description, callable $command): void
    {
        $this->items[] = new Item($shortcut, $description, $command);
    }

    public function run(string $filePath): void
    {
        $this->showInstructions();

        $lines = file($filePath);

        foreach ($lines as $line)
        {
            $params = explode(' ', trim($line));
            $command = $params[0];
            $params = array_slice($params, 1, count($params));
            $param = $params ? implode(' ', $params) : null;

            $this->executeCommand($command, $param);
        }
    }

    public function showInstructions(): void
    {
        foreach ($this->items as $item)
        {
            print_r($item->getShortcut() . ': ' . $item->getDescription() . '</br>');
        }
    }

    public function exit(): void
    {
        $this->exit = true;
    }

    private function executeCommand(string $command, ?string $param = null): void
    {
        $this->exit = false;

        $item = $this->findItem($command);
        if ($item === null)
        {
            throw new InvalidCommandException('Invalid command');
        }

        if ($item)
        {
            $item->getCommand()($param);
        }
    }

    private function findItem(string $command): ?Item
    {
        foreach ($this->items as $item)
        {
            if ($item->getShortcut() === $command)
            {
                return $item;
            }
        }

        return null;
    }
}