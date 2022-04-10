<?php
declare(strict_types=1);

namespace Command\Tests;

use Command\Document\Document;
use Command\DocumentExporter\DocumentHtmlExporter;

class MockDocument extends Document
{
    public function save(string $fileName): void
    {
        file_put_contents($fileName . '.html', $this->getTitle());
    }
}