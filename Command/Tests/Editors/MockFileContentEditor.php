<?php
declare(strict_types=1);

namespace Command\Tests;

use Command\Editor\Editor;
use Command\History\History;
use Command\Menu\Menu;

class MockFileContentEditor extends Editor
{
    public function __construct(Menu $menu, History $history)
    {
        parent::__construct($menu, $history);

        $this->document = new MockFileContentDocument($history);
    }
}