<?php
declare(strict_types=1);

namespace Command\DocumentExporter;

use Command\Data\DocumentItem;
use Command\Data\Image\ImageInterface;
use Command\Data\Paragraph\ParagraphInterface;
use Command\Document\DocumentInterface;

class DocumentItemsToHTMLConverter
{
    /** @var string */
    private $fileContent = '';

    /**
     * @param string $title
     * @param DocumentItem[] $items
     * @return string
     */
    public function convert(string $title, array $items): string
    {
        $this->generateHTMLTop($title);
        $this->generateHTMLBody($items);
        $this->generateHTMLBottom();

        return $this->fileContent;
    }

    private function generateHTMLTop(string $title): void
    {
        $this->fileContent = '<!DOCTYPE html><html><head><title>'
            . $title
            . '</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
    }

    private function generateHTMLBody(array $items): void
    {
        for ($i = 0; $i < count($items); $i++)
        {
            $item = $items[$i];
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

    private function generateHTMLBottom(): void
    {
        $this->fileContent .= '</body></html>';
    }

    private function addImage(ImageInterface $image): void
    {
        $this->fileContent .= '<img width="' . $image->getWidth() . 'px" height="' . $image->getHeight() .'px" src="' . $image->getPath() . '"/>';
    }

    private function addParagraph(ParagraphInterface $paragraph): void
    {
        $this->fileContent .= '<p>' . htmlspecialchars($paragraph->getText(), ENT_QUOTES | ENT_HTML5) . '</p>';
    }
}