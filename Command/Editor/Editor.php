<?php
declare(strict_types=1);

namespace Command\Editor;

use Command\Document\DocumentInterface;
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
        $this->addMenuItem('setTitle', 'Set title', 'setTitle');
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

    private function setTitle(string $in): void
    {
        $this->document::setTitle($in);
    }
}