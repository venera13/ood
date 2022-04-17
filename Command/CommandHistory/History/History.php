<?php
declare(strict_types=1);

namespace Command\History;

use Command\Command\CommandInterface;

class History
{
    const MAX_HISTORY_DEPTH = 10;

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
            --$this->nextCommandIndex;
            $this->commands[$this->nextCommandIndex]->unexecute();
        }
    }

    public function canRedo(): bool
    {
        return $this->nextCommandIndex !== count($this->commands);
    }

    public function redo(): void
    {
        if ($this->canRedo())
        {
            $this->commands[$this->nextCommandIndex]->execute();
            ++$this->nextCommandIndex;
        }
    }

    public function addAndExecuteCommand(CommandInterface $command): void
    {
        if ($this->nextCommandIndex < count($this->commands))
        {
            for ($i = $this->nextCommandIndex; $i < count($this->commands); $i++)
            {
                $this->commands[$i]->destroy();
            }

            $this->commands = array_splice($this->commands, 0, $this->nextCommandIndex);
        }

        $command->execute();
        $this->commands[] = $command;
        ++$this->nextCommandIndex;

        if (count($this->commands) == self::MAX_HISTORY_DEPTH)
        {
            $this->commands = array_splice($this->commands, 1, self::MAX_HISTORY_DEPTH - 1);
            $this->nextCommandIndex = self::MAX_HISTORY_DEPTH - 1;
        }
    }
}