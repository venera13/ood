<?php
declare(strict_types=1);

namespace Command\DocumentExporter;

use Command\Data\Image\ImageInterface;
use Command\Data\Paragraph\ParagraphInterface;
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
        for ($i = 0; $i < $this->document->getItemsCount(); $i++)
        {
            $item = $this->document->getItem($i);
            if ($item->getImage())
            {
                $this->addImage($item->getImage());
            }
            else
            {
                $this->addParagraph($item->getText());
            }
        }
    }

    private function addFileBottom(): void
    {
        $this->fileContent .= '</body></html>';
    }

    private function addImage(ImageInterface $image): void
    {
        $this->fileContent .= '<img width="' . $image->getWidth() . 'px" height="' . $image->getHeight() .'px" src="' . $image->getPath() . '"/>';
    }

    private function addParagraph(ParagraphInterface $paragraph): void
    {
        $this->fileContent .= '<p>' . $paragraph->getText() . '</p>';
    }
}