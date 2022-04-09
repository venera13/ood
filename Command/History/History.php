<?php
declare(strict_types=1);

namespace Command\History;

use Command\Command\CommandInterface;

class History
{
    /** @var int */
    private $nextCommandIndex = 0;
    /** @var CommandInterface[] */
    private $commands = [];

    public function canUndo(): bool
    {
        return $this->nextCommandIndex !== 0;
    }

    public function undo(): void
    {
        if ($this->canUndo())
        {
            $this->commands[$this->nextCommandIndex - 1]->unexecute();
            --$this->nextCommandIndex;
        }
    }

    public function canRedo(): bool
    {
        return $this->nextCommandIndex !== count($this->commands); //TODO: добавить проверку на исключение
    }

    public function redo(): void
    {
        if ($this->canRedo())
        {
            $this->commands[$this->nextCommandIndex]->execute(); //TODO: добавить проверку на исключение
            ++$this->nextCommandIndex;
        }
    }

    public function addAndExecuteCommand(CommandInterface $command): void
    {
        $command->execute(); //TODO: добавить проверку на исключение
        $this->commands[] = $command;
        ++$this->nextCommandIndex;
    }
}