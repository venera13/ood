<?php
declare(strict_types=1);

namespace Command\Command;

class ChangeStringCommand implements CommandInterface
{
    /** @var string */
    private $target;
    /** @var string */
    private $newValue;

    public function __construct(string &$target, string &$newValue)
    {
        $this->target = &$target;
        $this->newValue = &$newValue;
    }

    public function execute(): void
    {
        $this->swap($this->target, $this->newValue);
    }

    public function unexecute(): void
    {
        $this->swap($this->target, $this->newValue);
    }

    private function swap(&$a, &$b): void
    {
        [$a, $b] = [$b, $a];
    }
}