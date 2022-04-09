<?php
declare(strict_types=1);

namespace Command\DocumentExporter;

use Command\Document\DocumentInterface;

class DocumentHtmlExporter implements DocumentExporterInterface
{
    /** @var DocumentInterface */
    private $document;
    /** @var string */
    private $fileContent = '';

    public function __construct(DocumentInterface $document)
    {
        $this->document = $document;
    }

    public function generate(): string
    {
        $this->addFileTop();
        $this->addFileBody();
        $this->addFileBottom();

        return $this->fileContent;
    }

    private function addFileTop(): void
    {
        $this->fileContent = '<!DOCTYPE html><html><head><title>'
            . $this->document->getTitle()
            . '</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
    }

    private function addFileBody(): void
    {

    }

    private function addFileBottom(): void
    {
        $this->fileContent .= '</body></html>';
    }
}