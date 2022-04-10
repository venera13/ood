<?php
declare(strict_types=1);

namespace Command\Editor;

use Command\Document\DocumentInterface;
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

    public function start(string $filePath): void
    {
        try
        {
            $this->menu->run($filePath);
        }
        catch(InvalidCommandException $exception)
        {
            echo ($exception->getMessage());
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
        $this->addMenuItem('setTitle', 'Changes title. Args: < new title >', 'setTitle');
        $this->addMenuItem('insertParagraph', 'Add paragraph. Args: < text position|end  >', 'insertParagraph');
        $this->addMenuItem('undo', 'Undo command', 'undo');
        $this->addMenuItem('redo', 'Redo command', 'redo');
        $this->addMenuItem('list', 'Show document', 'list');
        $this->addMenuItem('save', 'Save as html Args: < filePath >', 'save');
    }

    private function addMenuItem(string $shortcut, string $description, string $command): void
    {
        $this->menu->addItem($shortcut, $description, $this->makeCommand($command));
    }

    public function makeCommand(string $command): callable
    {
        return function($args) use ($command)
        {
            return $this->$command($args);
        };
    }

    private function setTitle(string $title): void
    {
        $this->document->setTitle($title);
    }

    private function insertParagraph(string $args): void
    {
        $params = explode(' ', trim($args));
        $position = $params[count($params) - 1];
        $position = $position === 'end' ? $position : (int) $position;
        if (!$position)
        {
            echo('Incorrect paragraph position</br>');
            return;
        }
        $params = array_slice($params, 0, count($params) - 1);
        $text = implode(' ', $params);
        try
        {
            $this->document->insertParagraph($text, gettype($position) !== 'string' ? $position : null);
        }
        catch (InvalidPositionException $exception)
        {
            echo('Incorrect paragraph position</br>');
        }
    }

    private function undo(): void
    {
        if ($this->document->canUndo())
        {
            $this->document->undo();
        }
        else
        {
            print_r("Can't undo</br>");
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
            print_r("Can't redo</br>");
        }
    }

    private function list(): void
    {
        print_r('-------------</br>');
        print_r('Title: ' . $this->document->getTitle() . '</br>');
        for ($i = 0; $i < $this->document->getItemsCount(); $i++)
        {
            $item = $this->document->getItem($i);
            if ($item->getImage())
            {
                $image = $item->getImage();
                print_r($i . '. Image: ' . $image->getWidth() . '*' . $image->getHeight() . ' ' . $image->getPath() . '</br>');
            }
            else
            {
                $paragraph = $item->getText();
                print_r($i . '. Paragraph: ' . $paragraph->getText() . '</br>');
            }
        }
        print_r('-------------</br>');
    }

    private function save(string $fileName): void
    {
        $this->document->save($fileName);
    }
}