<?php
declare(strict_types=1);

namespace Command\Data;

class Item
{
    /** @var string */
    private $shortcut;
    /** @var string */
    private $description;
    /** @var callable */
    private $command;

    public function __construct(string $shortcut, string $description, callable $command)
    {
        $this->shortcut = $shortcut;
        $this->description = $description;
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getShortcut(): string
    {
        return $this->shortcut;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return callable
     */
    public function getCommand(): callable
    {
        return $this->command;
    }
}