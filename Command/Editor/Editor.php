<?php
declare(strict_types=1);

namespace Command\Editor;

use Command\Document\DocumentInterface;
use Command\DocumentExporter\DocumentHtmlExporter;
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
        $this->menu->run($filePath);
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
        print_r($this->document->getTitle());
        print_r('-------------</br>');
    }

    private function save(string $fileName): void
    {
        $htmlExporter = new DocumentHtmlExporter($this->document);
        $fileContent = $htmlExporter->generate();
        file_put_contents($fileName, $fileContent);
    }
}