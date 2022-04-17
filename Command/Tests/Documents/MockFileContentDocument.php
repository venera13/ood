<?php
declare(strict_types=1);

namespace Command\Tests;

use Command\Document\Document;

class MockFileContentDocument extends Document
{
    public function save(string $fileName): void
    {
        $content = '';
        for ($i = 0; $i < $this->getItemsCount(); $i++)
        {
            $content .= $this->getItem($i)->getText() ? $this->getItem($i)->getText()->getText() : '';
        }
        file_put_contents($fileName . '.html', $content);
    }
}