<?php
declare(strict_types=1);

namespace Command\Tests;

use Command\Editor\Editor;
use Command\Exceptions\InvalidCommandException;
use Command\History\History;
use Command\Menu\Menu;
use ReflectionMethod;

class MockEditor extends Editor
{
    public function __construct(Menu $menu, History $history)
    {
        parent::__construct($menu, $history);
    }

    public function start(?Menu $menu = null, ?ReflectionMethod $method = null, ?string $fileName = null): void
    {
        try
        {
            $lines = file($fileName);

            foreach ($lines as $line)
            {
                $method->invoke($menu, $line);
            }
        }
        catch(InvalidCommandException $exception)
        {
            echo ($exception->getMessage() . PHP_EOL);
        }
    }
}