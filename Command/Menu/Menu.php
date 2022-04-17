<?php
declare(strict_types=1);

namespace Command\Menu;

use Command\Data\Item;
use Command\Exceptions\InvalidCommandException;
use RuntimeException;

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

    public function run(): void
    {
        $this->showInstructions();

        while ($this->exit === false)
        {
            $this->runCommand(readline());
        }
    }

    public function showInstructions(): void
    {
        foreach ($this->items as $item)
        {
            echo($item->getShortcut() . ': ' . $item->getDescription() . PHP_EOL);
        }
    }

    public function exit(): void
    {
        $this->exit = true;
    }

    private function runCommand(string $command): void
    {
        $params = explode(' ', str_replace(array("\r\n", "\r", "\n"), '', $command));
        $command = ltrim(rtrim($params[0]));

        $params = array_slice($params, 1, count($params));
        $param = $params ? implode(' ', $params) : null;

        try
        {
            $this->executeCommand($command, $param);
        }
        catch (RuntimeException $exception)
        {
            echo $exception->getMessage() . PHP_EOL;
        }
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