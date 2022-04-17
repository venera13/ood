<?php
declare(strict_types=1);

namespace Command\Tests;

use Command\Editor\Editor;
use Command\History\History;
use Command\Menu\Menu;

class MockEditor extends Editor
{
    public function __construct(Menu $menu, History $history)
    {
        parent::__construct($menu, $history);

        $this->document = new MockDocument($history);
    }
}