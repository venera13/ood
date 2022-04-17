<?php
declare(strict_types=1);

namespace Command\Command;

interface CommandInterface
{
    public function execute(): void;
    public function unexecute(): void;
    public function destroy(): void;
}