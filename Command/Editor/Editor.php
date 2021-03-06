<?php
declare(strict_types=1);

namespace Command\Editor;

use Command\Document\DocumentInterface;
use Command\Exceptions\CopyFileException;
use Command\Exceptions\InvalidCommandException;
use Command\Exceptions\InvalidPositionException;
use Command\Menu\Menu;

class Editor
{
    /** @var Menu */
    private $menu;
    /** @var DocumentInterface */
    private $document;

    public function __construct(Menu $menu, DocumentInterface $document)
    {
        $this->menu = $menu;
        $this->document = $document;

        $this->addCommands();
    }

    public function start(): void
    {
        try
        {
            $this->menu->run();
        }
        catch(InvalidCommandException $exception)
        {
            echo ($exception->getMessage() . PHP_EOL);
        }
    }

    private function addCommands(): void
    {
        $this->menu->addItem('help', 'Help', function ()
        {
            $this->menu->showInstructions();
        });
        $this->menu->addItem('exit', 'Exit', function ()
        {
            $this->menu->exit();
        });
        $this->menu->addItem('setTitle', 'Changes title. Args: < new title >', function ($args)
        {
            $this->setTitle($args);
        });
        $this->menu->addItem('insertParagraph', 'Add paragraph. Args: < position|end > < text >', function ($args)
        {
            $this->insertParagraph($args);
        });
        $this->menu->addItem('replaceText', 'Replace paragraph. Args: < position > < text>', function ($args)
        {
            $this->replaceText($args);
        });
        $this->menu->addItem('insertImage', 'Insert image. Args: < position|end > < width > < height > < path to image >', function ($args)
        {
            $this->insertImage($args);
        });
        $this->menu->addItem('resizeImage', 'Resize image. Args: < position > < width > < height >', function ($args)
        {
            $this->resizeImage($args);
        });
        $this->menu->addItem('deleteItem', 'Delete item. Args: < position >', function ($args)
        {
            $this->deleteItem($args);
        });
        $this->menu->addItem('undo', 'Undo command', function ()
        {
            $this->undo();
        });
        $this->menu->addItem('redo', 'Redo command', function ()
        {
            $this->redo();
        });
        $this->menu->addItem('list', 'Show document', function ()
        {
            $this->list();
        });
        $this->menu->addItem('save', 'Save as html Args: < filePath >', function ($args)
        {
            $this->save($args);
        });
    }

    private function setTitle(string $title): void
    {
        $this->document->setTitle($title);
    }

    private function insertParagraph(string $args): void
    {
        $params = explode(' ', trim($args));
        $position = $params[0];
        if ($position !== 'end' && !ctype_digit($position))
        {
            echo('Incorrect paragraph position' . PHP_EOL);
            return;
        }

        $position = $position === 'end' ? $position : (int) $position;
        $params = array_slice($params, 1, count($params));
        $text = implode(' ', $params);
        try
        {
            $this->document->insertParagraph($text, gettype($position) !== 'string' ? $position : null);
        }
        catch (InvalidPositionException $exception)
        {
            echo('Incorrect paragraph position' . PHP_EOL);
        }
    }

    private function replaceText(string $args): void
    {
        $params = explode(' ', trim($args));
        $position = $params[0];
        if (!ctype_digit($position))
        {
            echo('Incorrect paragraph position' . PHP_EOL);
            return;
        }
        $position = (int) $position;
        $params = array_slice($params, 1, count($params));
        $text = implode(' ', $params);
        try
        {
            $itemsCount = $this->document->getItemsCount();
            if ($position >= $itemsCount)
            {
                throw new InvalidPositionException();
            }
            $item = $this->document->getItem($position);

            $paragraph = $item->getText();
            if ($paragraph === null)
            {
                throw new InvalidPositionException();
            }

            $paragraph->setText($text);
        }
        catch (InvalidPositionException $exception)
        {
            echo('Incorrect paragraph position' . PHP_EOL);
        }
    }

    private function insertImage(string $args): void
    {
        $params = explode(' ', trim($args));
        $position = $params[0];
        if ($position !== 'end' && !ctype_digit($position))
        {
            echo('Incorrect paragraph position' . PHP_EOL);
            return;
        }

        $position = $position === 'end' ? $position : (int) $position;
        $width = (int) $params[1];
        $height = (int) $params[2];
        $path = $params[3];

        if (!$position || !$width || !$height)
        {
            throw new InvalidPositionException();
        }
        try
        {
            $this->document->insertImage($path, $width, $height, gettype($position) !== 'string' ? $position : null);
        }
        catch (CopyFileException $exception)
        {
            echo($exception->getMessage() . PHP_EOL);
        }
        catch (InvalidPositionException $exception)
        {
            echo('Incorrect paragraph position' . PHP_EOL);
        }
    }

    private function resizeImage(string $args): void
    {
        $params = explode(' ', trim($args));
        $position = $params[0];
        if (!ctype_digit($position))
        {
            echo('Incorrect paragraph position' . PHP_EOL);
            return;
        }

        $width = (int) $params[1];
        $height = (int) $params[2];

        if (!$width || !$height)
        {
            throw new InvalidPositionException();
        }
        try
        {
            $this->document->resizeImage($width, $height, (int)$position);
        }
        catch (InvalidPositionException $exception)
        {
            echo('Incorrect paragraph position' . PHP_EOL);
        }
    }

    private function deleteItem(string $args): void
    {
        $params = explode(' ', trim($args));
        $position = $params[0];
        if (count($params) !== 1 || !ctype_digit($position))
        {
            echo('Incorrect paragraph position' . PHP_EOL);
            return;
        }

        $this->document->deleteItem((int) $position);
    }

    private function undo(): void
    {
        if ($this->document->canUndo())
        {
            $this->document->undo();
        }
        else
        {
            print_r("Can't undo" . PHP_EOL);
        }
    }

    private function redo(): void
    {
        if ($this->document->canRedo())
        {
            $this->document->redo();
        }
        else
        {
            print_r("Can't redo" . PHP_EOL);
        }
    }

    private function list(): void
    {
        for ($i = 0; $i < $this->document->getItemsCount(); $i++)
        {
            $item = $this->document->getItem($i);
            if ($item->getImage())
            {
                $image = $item->getImage();
                print_r($i . '. Image: ' . $image->getWidth() . '*' . $image->getHeight() . ' ' . $image->getPath() . PHP_EOL);
            }
            else
            {
                $paragraph = $item->getText();
                print_r($i . '. Paragraph: ' . $paragraph->getText() . PHP_EOL);
            }
        }
        print_r('-------------' . PHP_EOL);
    }

    private function save(string $args): void
    {
        $params = explode(' ', trim($args));
        $fileName = $params[0];
        if (count($params) !== 1)
        {
            echo('Incorrect paragraph position' . PHP_EOL);
            return;
        }

        $this->document->save($fileName);
    }
}