<?php
declare(strict_types=1);

namespace Command\Tests;

use Command\Document\Document;

class MockImageParamsDocument extends Document
{
    public function save(string $fileName): void
    {
        $content = '';
        for ($i = 0; $i < $this->getItemsCount(); $i++)
        {
            $image = $this->getItem($i)->getImage();
            $content .= $image ? $image->getWidth() . ' ' . $image->getHeight() : '';
        }
        file_put_contents($fileName . '.html', $content);
    }
}